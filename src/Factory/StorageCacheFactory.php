<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\Cache\StorageCache;
use MSBios\Cache\StorageInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class StorageCacheFactory
 * @package MSBios\Assetic\Factory
 */
class StorageCacheFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return StorageCache
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new StorageCache(
            $container->build(StorageInterface::class, $options)
        );
    }
}
