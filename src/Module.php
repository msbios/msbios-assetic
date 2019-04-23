<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 * @link https://github.com/RWOverdijk/AssetManager
 */
namespace MSBios\Assetic;

use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;

/**
 * Class Module
 * @package MSBios\Assetic
 */
class Module extends \MSBios\Module implements ConsoleUsageProviderInterface
{
    /** @const VERSION */
    const VERSION = '1.0.8';

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function getDir()
    {
        return __DIR__;
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function getNamespace()
    {
        return __NAMESPACE__;
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
