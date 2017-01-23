<?php

namespace stesie\mudlib;

use stesie\mudlib\Event\DomainEvent;

interface EventStore
{
    /**
     * @param DomainEvent[] $events
     */
    public function storeEvents(array $events);
}