<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\AssetManager;
use MSBios\Assetic\Listener\AssetListener;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AssetListenerFactory
 * @package MSBios\Assetic\Factory
 */
class AssetListenerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AssetListener
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AssetListener(
            $container->get(AssetManager::class)
        );
    }
}
