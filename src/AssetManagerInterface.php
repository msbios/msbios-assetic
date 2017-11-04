<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic;

use Zend\Http\PhpEnvironment\Request;

/**
 * Interface AssetManagerInterface
 * @package MSBios\Assetic
 */
interface AssetManagerInterface
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function resolve(Request $request);
}
