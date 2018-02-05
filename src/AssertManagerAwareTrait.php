<?php
/**
 * Created by PhpStorm.
 * User: judzhin
 * Date: 2/5/18
 * Time: 6:13 PM
 */

namespace MSBios\Assetic;

/**
 * Trait AssertManagerAwareTrait
 * @package MSBios\Assetic
 */
trait AssertManagerAwareTrait
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
