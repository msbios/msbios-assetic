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
use MSBios\Assetic\ResolverManagerAwareTrait;
use Zend\Stdlib\ArrayUtils;

/**
 * Class CollectionResolver
 * @package MSBios\Assetic\Resolver
 */
class CollectionResolver implements ResolverInterface, ResolverManagerAwareInterface
{
    use ResolverManagerAwareTrait;

    /** @var array */
    protected $collection = [];

    /**
     * CollectionResolver constructor.
     * @param array $collection
     */
    public function __construct(array $collection)
    {
        $this->clearCollection();
        $this->addCollection($collection);
    }

    /**
     * @param array $collection
     * @return $this
     */
    public function addCollection(array $collection)
    {
        $this->collection = ArrayUtils::merge(
            $this->collection,
            $collection
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function clearCollection()
    {
        $this->collection = [];
        return $this;
    }

    /**
     * @param $path
     * @return AssetCollection|null
     */
    public function resolve($path)
    {
        if (! isset($this->collection[$path])) {
            return null;
        }

        /** @var array $assets */
        $assets = $this->collection[$path];

        /** @var AssetCollection $assetCollection */
        $assetCollection = new AssetCollection;
        $assetCollection->setTargetPath($path);

        /** @var string|null $mimeType */
        $mimeType = null;

        /** @var string $map */
        foreach ($assets as $map) {

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
}
