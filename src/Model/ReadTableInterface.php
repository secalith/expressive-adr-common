<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Model;

interface ReadTableInterface
{
    public function fetchItem($data);
    public function fetchItems($data);
}
