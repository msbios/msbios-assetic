<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

/**
 * Interface CacheManagerAwareInterface
 * @package MSBios\Assetic
 */
interface CacheManagerAwareInterface
{
    /**
     * @param CacheManagerInterface $cacheManager
     * @return mixed
     */
    public function setCacheManager(CacheManagerInterface $cacheManager);

    /**
     * @return mixed
     */
    public function getCacheManager();
}
