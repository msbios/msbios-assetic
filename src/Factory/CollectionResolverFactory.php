<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\Module;
use MSBios\Assetic\Resolver\CollectionResolver;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class CollectionResolverFactory
 * @package MSBios\Assetic\Factory
 */
class CollectionResolverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return CollectionResolver
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new CollectionResolver(
            $container->get(Module::class)['collections']
        );
    }
}
