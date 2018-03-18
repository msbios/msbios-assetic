<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Cache;

use Assetic\Cache\CacheInterface;
use Zend\Cache\Storage\StorageInterface;

/**
 * Class StorageCache
 * @package MSBios\Assetic\Cache
 */
class StorageCache implements CacheInterface
{
    /** @var StorageInterface */
    protected $storage;

    /**
     * ZendCache constructor.
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Checks if the cache has a value for a key.
     *
     * @param string $key A unique key
     *
     * @return Boolean Whether the cache has a value for this key
     */
    public function has($key)
    {
        return $this->storage->hasItem($key);
    }

    /**
     * Returns the value for a key.
     *
     * @param string $key A unique key
     *
     * @return string|null The value in the cache
     */
    public function get($key)
    {
        return $this->storage->getItem($key);
    }

    /**
     * Sets a value in the cache.
     *
     * @param string $key A unique key
     * @param string $value The value to cache
     */
    public function set($key, $value)
    {
        return $this->storage->setItem($key, $value);
    }

    /**
     * Removes a value from the cache.
     *
     * @param string $key A unique key
     */
    public function remove($key)
    {
        // TODO: Implement remove() method.
    }
}
