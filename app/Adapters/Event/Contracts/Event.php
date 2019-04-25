<?php

namespace App\Adapters\Event\Contracts;

interface Event
{
    public function fire($event, $payload = [], $halt = false);
}
