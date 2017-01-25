<?php

namespace stesie\mudlib;

use stesie\mudlib\Event\DomainEventInterface;

interface EventStoreInterface
{
    /**
     * @param DomainEventInterface[] $events
     */
    public function storeEvents(array $events);
}