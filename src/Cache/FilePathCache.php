<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Cache;

use Assetic\Cache\CacheInterface;
use MSBios\Assetic\Exception\RuntimeException;
use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\ErrorHandler;

/**
 * Class FilePathCache
 * @package MSBios\Assetic\Cache
 */
class FilePathCache extends AbstractOptions implements CacheInterface
{
    /** @var string */
    protected $dirname;

    /** @var string */
    protected $filename;

    /** @var string */
    protected $pathname;

    /**
     * FilePathCache constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        //$this->dirname = $options['dirname'];
        //$this->filename = $options['filename'];
        //$this->pathname = rtrim($this->dirname, DIRECTORY_SEPARATOR)
        //    . DIRECTORY_SEPARATOR . ltrim($this->filename, DIRECTORY_SEPARATOR);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return file_exists($this->pathname);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return bool|null|string
     */
    public function get($key)
    {
        if (! file_exists($this->pathname)) {
            throw new RuntimeException('There is no cached value for ' . $this->filename);
        }

        return file_get_contents($this->pathname);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @param string $value
     * @throws \ErrorException
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
        $tmpfilepath = $cachedir . '/MSBiosAssetic' . $filename;

        if (@file_put_contents($tmpfilepath, $value, LOCK_EX) === false) {
            throw new RuntimeException('Unable to write file ' . $this->pathname);
        }

        rename($tmpfilepath, $this->pathname);
    }

    /**
     * @inheritdoc
     *
     * @param string $key
     * @return bool
     * @throws \ErrorException
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
