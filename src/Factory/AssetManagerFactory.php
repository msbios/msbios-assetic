<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\AssetManager;
use MSBios\Assetic\CacheManager;
use MSBios\Assetic\FilterManager;
use MSBios\Assetic\ResolverManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AssetManagerFactory
 * @package MSBios\Assetic\Factory
 */
class AssetManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AssetManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AssetManager(
            $container->get(ResolverManager::class),
            $container->get(CacheManager::class),
            $container->get(FilterManager::class)
        );
    }
}
