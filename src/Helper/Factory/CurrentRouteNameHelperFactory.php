<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Helper\Factory;

use Psr\Container\ContainerInterface;
use Secalith\ExpressiveAdrCommon\Helper\CurrentRouteNameHelper;
use Zend\Expressive\Helper\Exception\MissingRouterException;
use Zend\Expressive\Router\RouterInterface;

class CurrentRouteNameHelperFactory
{

    /**
     * @param ContainerInterface $container
     * @return CurrentRouteNameHelper
     */
    public function __invoke(ContainerInterface $container)
    {
        if (! $container->has(RouterInterface::class)) {
            throw new MissingRouterException(sprintf(
                '%s requires a %s implementation; none found in container',
                RouteHelper::class,
                RouterInterface::class
            ));
        }

        return new CurrentRouteNameHelper($container->get(RouterInterface::class));
    }
}
