<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use Assetic\Asset\AssetInterface;
use MSBios\Assetic\Exception\RuntimeException;
use Zend\Http\PhpEnvironment\Request;

/**
 * Class AssetManager
 * @package MSBios\Assetic
 */
class AssetManager implements AssetManagerInterface
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
     * @param CacheManagerInterface $cacheManager
     * @param FilterManagerInterface $filterManager
     */
    public function __construct(
        ResolverManagerInterface $resolverManager,
        CacheManagerInterface $cacheManager,
        FilterManagerInterface $filterManager
    ) {
        $this->resolverManager = $resolverManager;
        $this->cacheManager = $cacheManager;
        $this->filterManager = $filterManager;
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
}
