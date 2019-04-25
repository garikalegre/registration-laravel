<?php

namespace App\Adapters\Event;

use App\Adapters\Event\Contracts\Event as EventInterface;
use Illuminate\Events\Dispatcher;

class Event implements EventInterface
{
    /**
     * @var Dispatcher
     */
    private $eventDispatcher;

    /**
     * Event constructor.
     * @param Dispatcher $eventDispatcher
     */
    public function __construct(Dispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param string|object $event
     * @param mixed $payload
     * @param bool $halt
     */
    public function fire($event, $payload = [], $halt = false)
    {
        $this->eventDispatcher->fire($event, $payload, $halt);
    }

}
