<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Assetic\Resolver;

/**
 * Interface MimeResolverAwareInterface
 * @package MSBios\Assetic\Resolver
 */
interface MimeResolverAwareInterface
{
    /**
     * @param MimeResolverInterface $mimeResolver
     * @return mixed
     */
    public function setMimeResolver(MimeResolverInterface $mimeResolver);

    /**
     * @return MimeResolverInterface
     */
    public function getMimeResolver();
}
