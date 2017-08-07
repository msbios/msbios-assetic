<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic;

use MSBios\Assetic\Resolver\ResolverInterface;
use Zend\Stdlib\PriorityQueue;

/**
 * Class ResolverManager
 * @package MSBios\Assetic
 */
class ResolverManager implements ResolverManagerInterface
{
    /**
     * @var PriorityQueue|ResolverInterface[]
     */
    protected $queue;

    /**
     * Constructor
     *
     * Instantiate the internal priority queue
     */
    public function __construct()
    {
        $this->queue = new PriorityQueue;
    }

    /**
     * @param $path
     * @return mixed
     */
    public function resolve($path)
    {
        /** @var ResolverInterface $resolver */
        foreach ($this->queue as $resolver) {
            if ($resource = $resolver->resolve($path)) {
                return $resource;
            }
        }

        return null;
    }

    /**
     * @param ResolverInterface $resolver
     * @param int $priority
     * @return mixed
     */
    public function attach(ResolverInterface $resolver, $priority = 1)
    {
        $this->queue->insert($resolver, $priority);
    }
}
