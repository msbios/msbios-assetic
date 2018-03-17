<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\AssetManager;
use MSBios\Assetic\Listener\DispatchErrorListener;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class DispatchErrorListenerFactory
 * @package MSBios\Assetic\Factory
 */
class DispatchErrorListenerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DispatchErrorListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DispatchErrorListener(
            $container->get(AssetManager::class)
        );
    }
}
