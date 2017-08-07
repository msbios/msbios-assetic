<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

/**
 * Interface ResolverManagerAwareInterface
 * @package MSBios\Assetic
 */
interface ResolverManagerAwareInterface
{
    /**
     * @param ResolverManagerInterface $resolverManager
     * @return $this
     */
    public function setResolverManager(ResolverManagerInterface $resolverManager);

    /**
     * @return ResolverManagerInterface
     */
    public function getResolverManager();
}
