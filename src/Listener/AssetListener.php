<?php
/**
 * @access protetced
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Listener;

use Assetic\Asset\AssetInterface;
use MSBios\Assetic\AssetManager;
use MSBios\Assetic\AssetManagerInterface;
use MSBios\Assetic\Module;
use Zend\EventManager\EventInterface;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zend\Http\Response;
use Zend\Mvc\Application;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AssetListener
 * @package MSBios\Assetic\Listener
 */
class AssetListener
{
    /**
     * @param EventInterface $event
     */
    public function onRender(EventInterface $event)
    {
        /** @var array $error */
        $error = $event->getError();

        if (empty($error) || Application::ERROR_ROUTER_NO_MATCH !== $error) {
            return;
        }

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $event->getTarget()
            ->getServiceManager();

        /** @var AssetManagerInterface $assetManager */
        $assetManager = $serviceManager->get(AssetManager::class);

        /** @var AssetInterface $asset */
        if (! $asset = $assetManager->resolve($event->getRequest())) {
            return;
        }

        /** @var Response $response */
        $response = $event->getResponse();

        /** @var HttpResponse $response */
        $response = $response ?: new HttpResponse;
        $response->setStatusCode(Response::STATUS_CODE_200);

        if ($serviceManager->get(Module::class)->get('default_cleanup_buffer')) {
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

        $event->setName(MvcEvent::EVENT_FINISH);
        $event->setResponse($response);
        $event->getTarget()->getEventManager()->triggerEvent($event);
    }
}
