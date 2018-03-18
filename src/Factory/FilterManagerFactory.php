<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\FilterManager;
use MSBios\Assetic\Module;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class FilterManagerFactory
 * @package MSBios\Assetic\Factory
 */
class FilterManagerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return FilterManager
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new FilterManager(
            $container,
            $container->get(Module::class)['filters']
        );
    }
}
