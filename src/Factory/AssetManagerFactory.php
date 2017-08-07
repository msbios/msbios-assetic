<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\AssetManager;
use MSBios\Assetic\AssetManagerInterface;
use MSBios\Assetic\CacheManager;
use MSBios\Assetic\CacheManagerInterface;
use MSBios\Assetic\FilterManager;
use MSBios\Assetic\FilterManagerInterface;
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
     * @return AssetManager|AssetManagerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var AssetManagerInterface $assetManager */
        $assetManager = new AssetManager(
            $container->get(ResolverManager::class)
        );

        if ($assetManager instanceof CacheManagerInterface) {
            $assetManager->setCacheManager(
                $container->get(CacheManager::class)
            );
        }

        if ($assetManager instanceof FilterManagerInterface) {
            $assetManager->setFilterManager(
                $container->get(FilterManager::class)
            );
        }

        return $assetManager;
    }
}
