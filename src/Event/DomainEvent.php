<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Id;

interface DomainEvent
{
    public function getAggregateId(): Id;
}