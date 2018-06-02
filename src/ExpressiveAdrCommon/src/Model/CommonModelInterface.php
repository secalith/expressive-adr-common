<?php

declare(strict_types=1);

namespace Secalith\ExpressiveAdrCommon\Model;

interface CommonModelInterface
{

    /**
     * @param array $data
     * @return array
     */
    public function exchangeArray(array $data = []);


    /**
     * @return array
     */
    public function toArray();

    /**
     * @return array
     */
    public function getArrayCopy();

}
