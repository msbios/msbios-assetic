<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

use Assetic\Asset\AssetInterface;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\PhpEnvironment\Request as HttpRequest;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\RequestInterface;
use Zend\Stdlib\ResponseInterface;

/**
 * Class AssetListenerAggregate
 * @package MSBios\Assetic
 */
class AssetListenerAggregate extends AbstractListenerAggregate implements AssetManagerAwareInterface
{
    use AssetManagerAwareTrait;

    /**
     * AssetListenerAggregate constructor.
     * @param AssetManagerInterface $assetManager
     */
    public function __construct(AssetManagerInterface $assetManager)
    {
        $this->setAssetManager($assetManager);
    }

    /**
     * @param EventManagerInterface $events
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events
            ->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError'], $priority);
    }

    /**
     * @param EventInterface|MvcEvent $e
     */
    public function onDispatchError(EventInterface $e)
    {
        if ($e->getError() !== Application::ERROR_ROUTER_NO_MATCH) {
            return;
        }

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $e
            ->getTarget()
            ->getServiceManager();

        /** @var RequestInterface $request */
        $request = $e->getRequest();

        if (! $request instanceof HttpRequest) {
            return;
        }

        /** @var AssetInterface $asset */
        if (! $asset = $this->getAssetManager()->resolve($request)) {
            return;
        }

        /** @var ResponseInterface $response */
        $response = $e->getResponse();

        /** @var ResponseInterface $response */
        $response = $response ?: new HttpResponse;
        $response->setStatusCode(HttpResponse::STATUS_CODE_200);

        if ($serviceManager->get(Module::class)['default_cleanup_buffer']) {
            // Only clean the output buffer if it's turned on and something
            // has been buffered.
            if (ob_get_length() > 0) {
                ob_clean();
            }
        }

        $response->setContent($asset->dump());
        $response->getHeaders()
            ->addHeaderLine('Content-Transfer-Encoding', 'binary')
            ->addHeaderLine('Content-Type', $asset->mimetype)
            ->addHeaderLine('Content-Length', mb_strlen($response->getContent(), '8bit'));

        $e->setName(MvcEvent::EVENT_FINISH);
        $e->setResponse($response);
        $e->getTarget()
            ->getEventManager()
            ->triggerEvent($e);
    }
}
