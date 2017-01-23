<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Id;
use stesie\mudlib\ValueObject\PlayerId;

final class PlayerWasCreatedDomainEvent implements DomainEvent
{
    /**
     * @var PlayerId
     */
    private $id;

    public function __construct(PlayerId $id)
    {
        $this->id = $id;
    }

    public function getAggregateId(): Id
    {
        return $this->id;
    }
}