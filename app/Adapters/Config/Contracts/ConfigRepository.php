<?php

namespace App\Adapters\Config\Contracts;

/**
 * Interface ConfigRepository
 * @package App\Adapters\Config\Contracts
 */
interface ConfigRepository
{
    /**
     * @param string $alias
     * @return mixed
     */
    public function get(string $alias);
}
