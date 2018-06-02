<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Middleware\Factory;

use Psr\Container\ContainerInterface;
use Secalith\ExpressiveAdrCommon\Helper\CurrentRouteNameHelper;
use Secalith\ExpressiveAdrCommon\Middleware\CurrentRouteNameMiddleware;

class CurrentRouteNameMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CurrentRouteNameMiddleware(
            $container->get(CurrentRouteNameHelper::class)
        );
    }
}