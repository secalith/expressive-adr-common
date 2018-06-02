<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Model;

interface WriteTableInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function saveItem($data);


    /**
     * @return array
     */
    public function updateItem($uid,$data);

}
