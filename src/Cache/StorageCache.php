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
     * StorageCache constructor.
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return $this
            ->storage
            ->hasItem($key);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return mixed|null|string
     */
    public function get($key)
    {
        return $this
            ->storage
            ->getItem($key);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function set($key, $value)
    {
        return $this
            ->storage
            ->setItem($key, $value);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     */
    public function remove($key)
    {
        // TODO: Implement remove() method.
    }
}
