<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Resolver;

use Assetic\Asset\AssetInterface;
use Assetic\Asset\FileAsset;
use MSBios\Assetic\Exception\InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;
use Zend\Stdlib\SplStack;

/**
 * Class PathStackResolver
 * @package MSBios\Assetic\Resolver
 */
class PathStackResolver implements ResolverInterface, MimeResolverAwareInterface
{
    use MimeResolverAwareTrait;

    /** @var SplStack */
    protected $paths;

    /**
     * PathStackResolver constructor.
     */
    public function __construct()
    {
        $this->clearPaths();
    }

    /**
     * @param $paths
     * @return $this
     */
    public function addPaths($paths)
    {
        /** @var string $path */
        foreach ($paths as $path) {
            $this->addPath($path);
        }

        return $this;
    }

    /**
     * Normalize a path for insertion in the stack
     *
     * @param  string $path
     * @return string
     */
    protected function normalizePath($path)
    {
        $path = rtrim($path, '/\\');
        $path .= DIRECTORY_SEPARATOR;
        return $path;
    }

    /**
     * Add a single path to the stack
     *
     * @param $path
     */
    public function addPath($path)
    {
        if (! is_string($path)) {
            throw new InvalidArgumentException(sprintf(
                'Invalid path provided; must be a string, received %s',
                gettype($path)
            ));
        }
        $this->paths[] = $this->normalizePath($path);
    }

    /**
     * Clear all paths
     *
     * @return void
     */
    public function clearPaths()
    {
        $this->paths = new SplStack;
    }

    /**
     * @param $path
     * @return AssetInterface|FileAsset|null
     */
    public function resolve($path)
    {
        if (/* $this->isLfiProtectionOn() && */ preg_match('#\.\.[\\\/]#', $path)) {
            return null;
        }

        /** @var string $path */
        foreach ($this->paths as $item) {

            /** @var \SplFileInfo $file */
            $file = new \SplFileInfo($item . $path);

            if ($file->isReadable() && ! $file->isDir()) {

                /** @var string $filePath */
                $filePath = $file->getRealPath();

                /** @var AssetInterface $asset */
                $asset = new FileAsset($filePath);
                $asset->mimetype = $this->getMimeResolver()->resolve($filePath);
                return $asset;
            }
        }
    }
}
