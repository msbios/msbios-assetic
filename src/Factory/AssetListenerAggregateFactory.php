<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\AssetListenerAggregate;
use MSBios\Assetic\AssetManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class AssetListenerAggregateFactory
 * @package MSBios\Assetic\Factory
 */
class AssetListenerAggregateFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AssetListenerAggregate|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AssetListenerAggregate($container->get(AssetManager::class));
    }
}
