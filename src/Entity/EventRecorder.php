<?php

namespace stesie\mudlib\Entity;


use stesie\mudlib\Event\DomainEvent;

trait EventRecorder
{
    /**
     * @var DomainEvent[]
     */
    private $recordedEvents = [];

    /**
     * @return DomainEvent[]
     */
    public function getRecordedEvents(): array
    {
        return $this->recordedEvents;
    }

    public function clearRecordedEvents()
    {
        $this->recordedEvents = [];
    }

    private function recordThat(DomainEvent $event)
    {
        $this->recordedEvents[] = $event;
    }
}