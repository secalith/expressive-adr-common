<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Service;

trait CacheServiceAwareTrait
{
    protected $cacheService;

    public function setCacheService($cacheService)
    {
        $this->cacheService = $cacheService;

        return $this;
    }

    public function getCacheService()
    {
        return $this->cacheService;
    }

}