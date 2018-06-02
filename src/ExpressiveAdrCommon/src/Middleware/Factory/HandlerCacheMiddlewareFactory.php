<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Middleware\Factory;

use Psr\Container\ContainerInterface;
use Secalith\ExpressiveAdrCommon\Middleware\HandlerCacheMiddleware;

class HandlerCacheMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        $config = $config['cache']??[];
        if( ! array_key_exists('enabled', $config))
        {
            $config['enabled'] = false;
        }
        if($config['enabled']) {
            if( ! isset($config['path'])) {
                throw new Exception('The cache path is not configured');
            }
            if( ! isset($config['lifetime'])) {
                throw new Exception('The cache lifetime is not configured');
            }



        }
        return new HandlerCacheMiddleware($config);
    }
}