<?php

namespace stesie\mudlib\Entity;


use stesie\mudlib\Event\DomainEvent;

trait EventRecorder
{
    private $recordedEvents = [];

    private function recordEvent(DomainEvent $event)
    {
        $this->recordedEvents[] = $event;
    }
}