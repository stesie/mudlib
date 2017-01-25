<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Id;

interface DomainEventInterface
{
    public function getAggregateId(): Id;
}