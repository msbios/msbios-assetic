<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\Module;
use MSBios\Assetic\Resolver\MapResolver;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class MapResolverFactory
 * @package MSBios\Assetic\Factory
 */
class MapResolverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MapResolver
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new MapResolver(
            $container->get(Module::class)['maps']
        );
    }
}
