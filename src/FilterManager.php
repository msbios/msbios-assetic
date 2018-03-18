<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Interop\Container\ContainerInterface;

/**
 * Class FilterManager
 * @package MSBios\Assetic
 */
class FilterManager implements FilterManagerInterface
{
    /** @var  ContainerInterface */
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
     * @return AssetInterface|AssetCache
     */
    public function filter(AssetInterface $asset, $path)
    {
        /** @var FilterInterface $filter */
        $filter = $this->find($path);

        if (! $filter instanceof FilterInterface) {
            return $asset;
        }

        $asset->ensureFilter($filter);

        //
        ///** @var AssetInterface $tmp */
        //$tmp = new AssetCache($asset, $cache);
        //$tmp->mimetype = $asset->mimetype;
        //return $tmp;
    }

    /**
     * @param $path
     * @return mixed|null
     */
    protected function find($path)
    {
        /** @var array $config */
        if (! isset($this->options[$path])) {
            return null;
        }

        /** @var array $config */
        $config = $this->options[$path];


        /** @var mixed $filter */
        $filter = $config['filter'];

        if (is_string($filter) && $this->container->has($config['filter'])) {
            return $this->container->build($filter, $config['options']);
        }

        return null;
    }
}
