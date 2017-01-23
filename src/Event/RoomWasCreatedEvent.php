<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\RoomId;

class RoomWasCreatedDomainEvent implements DomainEvent
{
    /**
     * @var RoomId
     */
    private $id;

    public function __construct(RoomId $id)
    {
        $this->id = $id;
    }
}