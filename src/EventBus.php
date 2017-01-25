<?php

namespace stesie\mudlib;

use stesie\mudlib\Event\DomainEventInterface;

class EventBus implements EventBusInterface
{
    private $eventSubscribers = [];

    public function publish(DomainEventInterface $domainEvent)
    {
        $eventName = get_class($domainEvent);

        if (!isset($this->eventSubscribers[$eventName])) {
            return;
        }

        foreach ($this->eventSubscribers[$eventName] as $subscriber) {
            $subscriber($domainEvent);
        }
    }

    public function subscribe(string $eventName, callable $callback)
    {
        if (!isset($this->eventSubscribers[$eventName])) {
            $this->eventSubscribers[$eventName] = [];
        }

        $this->eventSubscribers[$eventName][] = $callback;
    }
}