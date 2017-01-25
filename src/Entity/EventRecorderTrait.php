<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\DomainEventInterface;

trait EventRecorderTrait
{
    /**
     * @var DomainEventInterface[]
     */
    private $recordedEvents = [];

    /**
     * @return DomainEventInterface[]
     */
    public function getRecordedEvents(): array
    {
        return $this->recordedEvents;
    }

    public function clearRecordedEvents()
    {
        $this->recordedEvents = [];
    }

    private function recordThat(DomainEventInterface $event)
    {
        $this->recordedEvents[] = $event;
    }
}