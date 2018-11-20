<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\CacheManager;
use MSBios\Assetic\Module;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CacheManagerFactory
 * @package MSBios\Assetic\Factory
 */
class CacheManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CacheManager|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CacheManager(
            $container,
            $container->get(Module::class)['caching']
        );
    }
}
