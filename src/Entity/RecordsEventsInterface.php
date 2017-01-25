<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\DomainEventInterface;

interface RecordsEventsInterface
{
    /**
     * @return DomainEventInterface[]
     */
    public function getRecordedEvents(): array;

    public function clearRecordedEvents();
}