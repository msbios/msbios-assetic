<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Resolver;

use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetInterface;
use MSBios\Assetic\Exception\RuntimeException;
use MSBios\Assetic\ResolverManagerAwareInterface;
use MSBios\Assetic\ResolverManagerInterface;
use Zend\Config\Config;
use Zend\Stdlib\ArrayUtils;

/**
 * Class CollectionResolver
 * @package MSBios\Assetic\Resolver
 */
class CollectionResolver implements ResolverInterface, ResolverManagerAwareInterface
{
    /** @var Config */
    protected $collection = [];

    /** @var ResolverManagerInterface */
    protected $resolverManager;

    /**
     * CollectionResolver constructor.
     * @param Config $collection
     */
    public function __construct(Config $collection)
    {
        $this->clearCollections();
        $this->addCollections($collection);
    }

    /**
     * @param Config $collection
     * @return $this
     */
    public function addCollections(Config $collection)
    {
        $this->collection = new Config(ArrayUtils::merge(
            $this->collection->toArray(),
            $collection->toArray()
        ));

        return $this;
    }

    /**
     * @return $this
     */
    public function clearCollections()
    {
        $this->collection = new Config([]);
        return $this;
    }

    /**
     * @param $path
     * @return AssetCollection|null
     */
    public function resolve($path)
    {
        if (! $collection = $this->collection->get($path)) {
            return null;
        }

        /** @var AssetCollection $assetCollection */
        $assetCollection = new AssetCollection;
        $assetCollection->setTargetPath($path);

        /** @var string|null $mimeType */
        $mimeType = null;

        /** @var string $map */
        foreach ($collection as $map) {

            /** @var AssetInterface $asset */
            if ($asset = $this->getResolverManager()->resolve($map)) {
                if (null !== $mimeType && $asset->mimetype !== $mimeType) {
                    throw new RuntimeException(sprintf(
                        'Asset "%s" from collection "%s" doesn\'t have the expected mime-type "%s".',
                        $asset,
                        $path,
                        $mimeType
                    ));
                }

                /** @var string $mimeType */
                $mimeType = $asset->mimetype;
                $assetCollection->add($asset);
            }
        }

        $assetCollection->mimetype = 'text/plain';

        return $assetCollection;
    }

    /**
     * @param ResolverManagerInterface $resolverManager
     * @return $this
     */
    public function setResolverManager(ResolverManagerInterface $resolverManager)
    {
        $this->resolverManager = $resolverManager;
        return $this;
    }

    /**
     * @return ResolverManagerInterface
     */
    public function getResolverManager()
    {
        return $this->resolverManager;
    }
}
