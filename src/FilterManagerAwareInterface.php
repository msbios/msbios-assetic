<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

/**
 * Interface FilterManagerAwareInterface
 * @package MSBios\Assetic
 */
interface FilterManagerAwareInterface
{
    /**
     * @param FilterManagerInterface $filterManager
     * @return mixed
     */
    public function setFilterManager(FilterManagerInterface $filterManager);

    /**
     * @return mixed
     */
    public function getFilterManager();
}
