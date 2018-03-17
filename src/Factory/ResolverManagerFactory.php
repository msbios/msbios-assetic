<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Assetic\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Assetic\Exception\RuntimeException;
use MSBios\Assetic\Exception\ServiceNotFoundException;
use MSBios\Assetic\Module;
use MSBios\Assetic\Resolver\MimeResolver;
use MSBios\Assetic\Resolver\MimeResolverAwareInterface;
use MSBios\Assetic\Resolver\ResolverInterface;
use MSBios\Assetic\ResolverManager;
use MSBios\Assetic\ResolverManagerAwareInterface;
use MSBios\Assetic\ResolverManagerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class ResolverManagerFactory
 * @package MSBios\Assetic\Factory
 */
class ResolverManagerFactory implements FactoryInterface
{
    protected $mimeResolver;

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ResolverManager|ResolverManagerInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var ResolverManagerInterface $resolverManager */
        $resolverManager = new ResolverManager;

        /** @var array $options */
        $options = $container->get(Module::class);

        /**
         * @var string $resolverName
         * @var int $priority
         */
        foreach ($options['resolvers'] as $resolverName => $priority) {
            if (! $container->has($resolverName)) {
                throw new ServiceNotFoundException(
                    "Can not find resolver by name '{$resolverName}'"
                );
            }

            /** @var ResolverInterface $resolver */
            $resolver = $container->get($resolverName);

            if (! $resolver instanceof ResolverInterface) {
                throw new RuntimeException(
                    "Resolver '{$resolverName}' does not implement the required interface " . ResolverInterface::class
                );
            }

            if ($resolver instanceof ResolverManagerAwareInterface) {
                $resolver->setResolverManager($resolverManager);
            }

            if ($resolver instanceof MimeResolverAwareInterface) {
                $resolver->setMimeResolver(
                    $container->get(MimeResolver::class)
                );
            }

            $resolverManager->attach($resolver, $priority);
        }

        return $resolverManager;
    }
}
