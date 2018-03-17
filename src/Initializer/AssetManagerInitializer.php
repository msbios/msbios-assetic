<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Initializer;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\AssertManagerAwareInterface;
use MSBios\Assetic\AssetManager;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class AssetManagerInitializer
 * @package MSBios\Assetic\Initializer
 */
class AssetManagerInitializer implements InitializerInterface
{
    /**
     * @param ContainerInterface $container
     * @param object $instance
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof AssertManagerAwareInterface) {
            $instance->setAssetManager($container->get(AssetManager::class));
        }
    }

    /**
     * @param $an_array
     * @return AssetManagerInitializer
     */
    public static function __set_state($an_array)
    {
        return new self();
    }
}
