<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use Assetic\Asset\AssetInterface;
use MSBios\Assetic\Exception\RuntimeException;
use Zend\Http\PhpEnvironment\Request;
use Zend\Stdlib\RequestInterface;

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
     * @param FilterManagerInterface $filterManager
     * @param CacheManagerInterface $cacheManager
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
     * @param RequestInterface|Request $request
     * @return bool|mixed
     */
    public function resolve(RequestInterface $request)
    {
        /** @var string $path */
        $path = substr($request->getUri()->getPath(), strlen($request->getBasePath()) + 1);

        /** @var AssetInterface $asset */
        if (! $asset = $this->resolverManager->resolve($path)) {
            return false;
        }

        if (empty($asset->mimetype)) {
            throw new RuntimeException(
                'Expected property "mimetype" on asset.'
            );
        }

        $this
            ->filterManager
            ->filter($asset, $path);

        return $this
            ->cacheManager
            ->cache($asset, $path);
    }
}
