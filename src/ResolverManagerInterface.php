<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use MSBios\Assetic\Resolver\ResolverInterface;

/**
 * Interface ResolverManagerInterface
 * @package MSBios\Assetic
 */
interface ResolverManagerInterface extends ResolverInterface
{
    /**
     * @param ResolverInterface $resolver
     * @param int $priority
     * @return mixed
     */
    public function attach(ResolverInterface $resolver, $priority = 1);
}
