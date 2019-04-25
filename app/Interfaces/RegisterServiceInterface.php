<?php

namespace App\Interfaces;

interface RegisterServiceInterface
{
    /**
     * @param array $data
     * @param string $ip
     * @return mixed
     */
    public function registerUser(array $data, string $ip);
}
