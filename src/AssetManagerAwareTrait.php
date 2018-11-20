<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

/**
 * Trait AssetManagerAwareTrait
 * @package MSBios\Assetic
 */
trait AssetManagerAwareTrait
{
    /** @var AssetManagerInterface */
    protected $assetManager;

    /**
     * @return AssetManagerInterface
     */
    public function getAssetManager()
    {
        return $this->assetManager;
    }

    /**
     * @param AssetManagerInterface $assetManager
     * @return $this
     */
    public function setAssetManager(AssetManagerInterface $assetManager)
    {
        $this->assetManager = $assetManager;
        return $this;
    }
}
