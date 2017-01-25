<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\AbstractId;

interface DomainEventInterface
{
    public function getAggregateId(): AbstractId;
}