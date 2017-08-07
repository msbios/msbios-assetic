<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\Module;
use MSBios\Assetic\Resolver\PathStackResolver;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class PathStackResolverFactory
 * @package MSBios\Assetic\Factory
 */
class PathStackResolverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return $this
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return (new PathStackResolver)->addPaths(
            $container->get(Module::class)->get('paths')
        );
    }
}
