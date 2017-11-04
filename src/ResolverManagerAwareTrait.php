<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

/**
 * Trait ResolverManagerAwareTrait
 * @package MSBios\Assetic
 */
trait ResolverManagerAwareTrait
{
    /** @var ResolverManagerInterface */
    protected $resolverManager;

    /**
     * @param ResolverManagerInterface $resolverManager
     * @return $this
     */
    public function setResolverManager(ResolverManagerInterface $resolverManager)
    {
        $this->resolverManager = $resolverManager;
        return $this;
    }

    /**
     * @return ResolverManagerInterface
     */
    public function getResolverManager()
    {
        return $this->resolverManager;
    }
}
