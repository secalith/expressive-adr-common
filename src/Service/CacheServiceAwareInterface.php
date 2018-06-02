<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Service;

interface CacheServiceAwareInterface
{
    public function setCacheService($cacheService);
    public function getCacheService();
}