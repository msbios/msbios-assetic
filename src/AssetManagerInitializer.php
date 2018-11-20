<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class AssetManagerInitializer
 * @package MSBios\Assetic
 */
class AssetManagerInitializer implements InitializerInterface
{
    /**
     * @param ContainerInterface $container
     * @param object $instance
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof AssetManagerAwareInterface) {
            $instance
                ->setAssetManager($container->get(AssetManager::class));
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
