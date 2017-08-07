<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Resolver;

use Assetic\Asset\AssetInterface;
use Assetic\Asset\FileAsset;
use Assetic\Asset\HttpAsset;
use Zend\Config\Config;
use Zend\Stdlib\ArrayUtils;

/**
 * Class MapResolver
 * @package MSBios\Assetic\Resolver
 */
class MapResolver implements ResolverInterface, MimeResolverAwareInterface
{
    /** @var Config */
    protected $maps;

    /** @var MimeResolverInterface */
    protected $mimeResolver;

    /**
     * MapResolver constructor.
     * @param Config $maps
     */
    public function __construct(Config $maps)
    {
        $this->clearMaps();
        $this->addMaps($maps);
    }

    /**
     * @param Config $maps
     * @return $this
     */
    public function addMaps(Config $maps)
    {
         $this->maps = new Config(ArrayUtils::merge(
             $this->maps->toArray(),
             $maps->toArray()
         ));

         return $this;
    }

    /**
     * @return $this
     */
    public function clearMaps()
    {
        /** @var Config maps */
        $this->maps = new Config([]);
        return $this;
    }

    /**
     * @param $path
     * @return AssetInterface|FileAsset|HttpAsset|null
     */
    public function resolve($path)
    {
        if (! $source = $this->maps->get($path)) {
            return null;
        }

        /** @var AssetInterface $asset */
        $asset = (! filter_var($source, FILTER_VALIDATE_URL))
            ? new FileAsset($source) : new HttpAsset($source);

        $asset->mimetype = $this->getMimeResolver()
            ->resolve($source);

        return $asset;
    }

    /**
     * @param MimeResolverInterface $mimeResolver
     * @return $this
     */
    public function setMimeResolver(MimeResolverInterface $mimeResolver)
    {
        $this->mimeResolver = $mimeResolver;
        return $this;
    }

    /**
     * @return MimeResolverInterface
     */
    public function getMimeResolver()
    {
        return $this->mimeResolver;
    }
}
