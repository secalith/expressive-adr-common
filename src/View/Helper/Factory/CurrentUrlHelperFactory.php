<?php

namespace Secalith\ExpressiveAdrCommon\View\Helper\Factory;

use Psr\Container\ContainerInterface;
use Secalith\ExpressiveAdrCommon\View\Helper\CurrentUrlHelper;

class CurrentUrlHelperFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return $container->get(CurrentUrlHelper::class);
    }
}