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

    /** @var FilterManagerInterface */
    protected $filterManager;

    /** @var CacheManagerInterface */
    protected $cacheManager;

    /**
     * AssetManager constructor.
     * @param ResolverManagerInterface $resolverManager
     * @param CacheManagerInterface $cacheManager
     * @param FilterManagerInterface $filterManager
     */
    public function __construct(
        ResolverManagerInterface $resolverManager,
        FilterManagerInterface $filterManager,
        CacheManagerInterface $cacheManager
    ) {
        $this->resolverManager = $resolverManager;
        $this->filterManager = $filterManager;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @param Request $request
     * @return bool
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

        $this->filterManager->filter($asset, $path);
        /** @var AssetInterface $asset */
        return $this->cacheManager->cache($asset, $path);
    }
}
