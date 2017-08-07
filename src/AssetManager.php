<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use Assetic\Asset\AssetInterface;
use MSBios\Assetic\Exception\RuntimeException;
use Zend\Config\Config;
use Zend\Http\PhpEnvironment\Request;

/**
 * Class AssetManager
 * @package MSBios\Assetic
 */
class AssetManager implements CacheManagerAwareInterface, FilterManagerAwareInterface
{
    /** @var ResolverManagerInterface */
    protected $resolverManager;

    /** @var CacheManagerInterface */
    protected $cacheManager;

    /** @var FilterManagerInterface */
    protected $filterManager;

    /**
     * AssetManager constructor.
     * @param ResolverManagerInterface $resolverManager
     */
    public function __construct(ResolverManagerInterface $resolverManager)
    {
        $this->resolverManager = $resolverManager;
    }

    /**
     * @param Request $request
     * @return AssetInterface|bool
     */
    public function resolve(Request $request)
    {
        /** @var string $fullPath */
        $fullPath = $request->getUri()
            ->getPath();

        /** @var string $path */
        $path = substr($fullPath, strlen($request->getBasePath()) + 1);

        /** @var AssetInterface $asset */
        if (! $asset = $this->resolverManager->resolve($path)) {
            return false;
        }

        if (empty($asset->mimetype)) {
            throw new RuntimeException(
                'Expected property "mimetype" on asset.'
            );
        }

        // $this->getAssetFilterManager()->setFilters($this->path, $this->asset);
        // $this->asset    = $this->getAssetCacheManager()->setCache($this->path, $this->asset);
        // $mimeType       = $this->asset->mimetype;
        // $assetContents  = $this->asset->dump();
        // @codeCoverageIgnoreStart
        //if (function_exists('mb_strlen')) {
        //    $contentLength = mb_strlen($assetContents, '8bit');
        //} else {
        //    $contentLength = strlen($assetContents);
        //}
        // @codeCoverageIgnoreEnd

        return $asset;
    }

    /**
     * @param CacheManagerInterface $cacheManager
     * @return $this
     */
    public function setCacheManager(CacheManagerInterface $cacheManager)
    {
        $this->cacheManager = $cacheManager;
        return $this;
    }

    /**
     * @return CacheManagerInterface
     */
    public function getCacheManager()
    {
        return $this->cacheManager;
    }

    /**
     * @param FilterManagerInterface $filterManager
     * @return $this
     */
    public function setFilterManager(FilterManagerInterface $filterManager)
    {
        $this->filterManager = $filterManager;
        return $this;
    }

    /**
     * @return FilterManagerInterface
     */
    public function getFilterManager()
    {
        return $this->filterManager;
    }
}
