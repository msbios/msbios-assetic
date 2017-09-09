<?php
/**
 * @access protetced
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Listener;

use Assetic\Asset\AssetInterface;
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
     * @param EventInterface $e
     */
    public function onDispatchError(EventInterface $e)
    {
        if ($e->getError() !== Application::ERROR_ROUTER_NO_MATCH) {
            return;
        }

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $e->getTarget()
            ->getServiceManager();

        /** @var AssetManagerInterface $assetManager */
        $assetManager = $serviceManager->get(AssetManagerInterface::class);

        /** @var AssetInterface $asset */
        if (! $asset = $assetManager->resolve($e->getRequest())) {
            return;
        }

        /** @var Response $response */
        $response = $e->getResponse();

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

        $e->setName(MvcEvent::EVENT_FINISH);
        $e->setResponse($response);
        $e->getTarget()
            ->getEventManager()
            ->triggerEvent($e);
    }
}
