<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\DomainEvent;

interface RecordsEvents
{
    /**
     * @return DomainEvent[]
     */
    public function getRecordedEvents(): array;

    public function clearRecordedEvents();
}