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
    use MimeResolverAwareTrait;

    /** @var array */
    protected $maps;

    /**
     * MapResolver constructor.
     * @param $maps
     */
    public function __construct($maps)
    {
        $this->clearMaps();
        $this->addMaps($maps);
    }

    /**
     * @param array $maps
     * @return $this
     */
    public function addMaps(array $maps)
    {
         $this->maps = ArrayUtils::merge(
             $this->maps,
             $maps
         );

         return $this;
    }

    /**
     * @return $this
     */
    public function clearMaps()
    {
        $this->maps = [];
        return $this;
    }

    /**
     * @param $path
     * @return AssetInterface|FileAsset|HttpAsset|null
     */
    public function resolve($path)
    {

        if (! isset($this->maps[$path])) {
            return null;
        }

        /** @var string $source */
        $source = $this->maps[$path];

        /** @var AssetInterface $asset */
        $asset = (! filter_var($source, FILTER_VALIDATE_URL))
            ? new FileAsset($source) : new HttpAsset($source);

        $asset->mimetype = $this->getMimeResolver()
            ->resolve($source);

        return $asset;
    }
}
