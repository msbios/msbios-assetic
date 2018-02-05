<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

/**
 * Interface AssertManagerAwareInterface
 * @package MSBios\Assetic
 */
interface AssertManagerAwareInterface
{
    /**
     * @return AssetManagerInterface
     */
    public function getAssetManager();

    /**
     * @param AssetManagerInterface $assetManager
     * @return $this
     */
    public function setAssetManager(AssetManagerInterface $assetManager);
}
