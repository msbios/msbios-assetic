<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 * @link https://github.com/RWOverdijk/AssetManager
 */
namespace MSBios\Assetic;

use MSBios\ModuleInterface;
use Zend\Console\Adapter\AdapterInterface;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;

/**
 * Class Module
 * @package MSBios\Assetic
 */
class Module implements ModuleInterface, AutoloaderProviderInterface, ConsoleUsageProviderInterface
{
    /** @const VERSION */
    const VERSION = '1.0.6';

    /**
     * @inheritdoc
     *
     * @return array|mixed|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            AutoloaderFactory::STANDARD_AUTOLOADER => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     *
     * @param AdapterInterface $console
     * @return array|null|string
     */
    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            'Warmup',
            'assetmanager warmup [--purge] [--verbose|-v]' => 'Warm AssetManager up',
            ['--purge', '(optional) forces cache flushing'],
            ['--verbose | -v', '(optional) verbose mode'],
        ];
    }
}
