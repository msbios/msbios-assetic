<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Resolver;

/**
 * Interface ResolverInterface
 * @package MSBios\Assetic\Resolver
 */
interface ResolverInterface
{
    /**
     * @param $path
     * @return mixed
     */
    public function resolve($path);
}
