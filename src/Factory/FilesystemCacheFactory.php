<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Assetic\Cache\FilesystemCache;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class FilesystemCacheFactory
 * @package MSBios\Assetic\Factory
 */
class FilesystemCacheFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return FilesystemCache|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new FilesystemCache($options['dirname']);
    }
}
