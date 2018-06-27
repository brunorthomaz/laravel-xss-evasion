<?php

namespace XSSEvasion\Contracts;

interface FilterInterface
{
    /**
     * @return mixed
     */
    public function filter($data);
}