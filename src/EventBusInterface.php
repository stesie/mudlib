<?php

namespace stesie\mudlib;

use stesie\mudlib\Event\DomainEventInterface;

interface EventBusInterface
{
    public function publish(DomainEventInterface $domainEvent);

    public function subscribe(string $eventName, callable $callback);
}