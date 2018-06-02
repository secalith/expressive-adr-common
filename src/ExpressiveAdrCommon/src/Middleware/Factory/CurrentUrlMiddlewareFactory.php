<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Middleware\Factory;

use Psr\Container\ContainerInterface;
use Secalith\ExpressiveAdrCommon\Middleware\CurrentUrlMiddleware;
use Secalith\ExpressiveAdrCommon\View\Helper\CurrentUrlHelper;

class CurrentUrlMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new CurrentUrlMiddleware(
            $container->get(CurrentUrlHelper::class)
        );
    }
}