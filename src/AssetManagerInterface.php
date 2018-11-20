<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

use Zend\Stdlib\RequestInterface;

/**
 * Interface AssetManagerInterface
 * @package MSBios\Assetic
 */
interface AssetManagerInterface
{
    /**
     * @param RequestInterface $request
     * @return mixed
     */
    public function resolve(RequestInterface $request);
}
