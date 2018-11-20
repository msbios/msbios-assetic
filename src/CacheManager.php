<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use Assetic\Asset\AssetCache;
use Assetic\Asset\AssetInterface;
use Assetic\Cache\CacheInterface;
use Interop\Container\ContainerInterface;

/**
 * Class CacheManager
 * @package MSBios\Assetic
 */
class CacheManager implements CacheManagerInterface
{
    /** @var ContainerInterface */
    protected $container;

    /** @var  array */
    protected $options;

    /**
     * CacheManager constructor.
     * @param ContainerInterface $container
     * @param array $options
     */
    public function __construct(ContainerInterface $container, array $options)
    {
        $this->container = $container;
        $this->options = $options;
    }

    /**
     * @param AssetInterface $asset
     * @param $path
     * @return AssetCache|AssetInterface
     */
    public function cache(AssetInterface $asset, $path)
    {
        /** @var CacheInterface $cache */
        $cache = $this->find($path);

        if (! $cache instanceof CacheInterface) {
            return $asset;
        }

        /** @var AssetInterface $tmp */
        $tmp = new AssetCache($asset, $cache);
        $tmp->mimetype = $asset->mimetype;
        return $tmp;
    }

    /**
     * @param $path
     * @return null
     */
    protected function find($path)
    {
        if (! isset($this->options[$path])) {
            return null;
        }

        /** @var array $options */
        $options = $this->options[$path];

        /** @var mixed $cache */
        $cache = $options['cache'];

        if (is_string($cache) && $this->container->has($options['cache'])) {
            return $this->container->build($cache, $options['options']);
        }

        return null;
    }
}
