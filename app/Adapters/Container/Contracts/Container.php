<?php

namespace App\Adapters\Container\Contracts;

/**
 * Interface Container
 * @package App\Adapters\Container\Contracts
 */
interface Container
{
    /**
     * @param string $className
     * @return mixed
     */
    public function make(string $className);


    public function makeWith(string $className, array $parameters = []);
}
