<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Cache;

use Assetic\Cache\CacheInterface;
use MSBios\Assetic\Exception\RuntimeException;
use Zend\Stdlib\ErrorHandler;

/**
 * Class FilePathCache
 * @package MSBios\Assetic\Cache
 */
class FilePathCache implements CacheInterface
{
    /** @var string */
    protected $dirname;

    /** @var string */
    protected $filename;

    /** @var string */
    protected $pathname;

    /**
     * FilePathCache constructor.
     * @param string $dirname
     * @param string $filename
     */
    public function __construct(array $options)
    {
        $this->dirname = $options['dirname'];
        $this->filename = $options['filename'];
        $this->pathname = rtrim($this->dirname, DIRECTORY_SEPARATOR)
            . DIRECTORY_SEPARATOR . ltrim($this->filename, DIRECTORY_SEPARATOR);
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
        return file_exists($this->pathname);
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
        if (! file_exists($this->pathname)) {
            throw new RuntimeException('There is no cached value for ' . $this->filename);
        }

        return file_get_contents($this->pathname);
    }

    /**
     * Sets a value in the cache.
     *
     * @param string $key A unique key
     * @param string $value The value to cache
     */
    public function set($key, $value)
    {
        /** @var array $pathinfo */
        $pathinfo = pathinfo($this->pathname);

        /** @var string $cachedir */
        $cachedir = $pathinfo['dirname'];

        /** @var string $filename */
        $filename = $pathinfo['basename'];

        ErrorHandler::start();

        if (! is_dir($cachedir)) {
            $umask = umask(0);
            mkdir($cachedir, 0777, true);
            umask($umask);
            // @codeCoverageIgnoreStart
        }

        // @codeCoverageIgnoreEnd
        ErrorHandler::stop();

        if (! is_writable($cachedir)) {
            throw new RuntimeException('Unable to write file ' . $this->pathname);
        }

        // Use "rename" to achieve atomic writes
        $tmpfilepath = $cachedir . '/MSBiosAsseticAssetManagerFilePathCache_' . $filename;

        if (@file_put_contents($tmpfilepath, $value, LOCK_EX) === false) {
            throw new RuntimeException('Unable to write file ' . $this->pathname);
        }

        rename($tmpfilepath, $this->pathname);
    }

    /**
     * Removes a value from the cache.
     *
     * @param string $key A unique key
     */
    public function remove($key)
    {
        ErrorHandler::start(\E_WARNING);

        /** @var  $result */
        $result = unlink($this->pathname);

        ErrorHandler::stop();

        if (! $result) {
            throw new RuntimeException(sprintf('Could not remove key "%s"', $this->pathname));
        }

        return $result;
    }
}
