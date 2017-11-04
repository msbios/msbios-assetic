<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Resolver;

/**
 * Trait MimeResolverAwareTrait
 * @package MSBios\Assetic\Resolver
 */
trait MimeResolverAwareTrait
{
    /** @var MimeResolverInterface */
    protected $mimeResolver;

    /**
     * @param MimeResolverInterface $mimeResolver
     * @return $this
     */
    public function setMimeResolver(ResolverInterface $mimeResolver)
    {
        $this->mimeResolver = $mimeResolver;
        return $this;
    }

    /**
     * @return MimeResolverInterface
     */
    public function getMimeResolver()
    {
        return $this->mimeResolver;
    }
}
