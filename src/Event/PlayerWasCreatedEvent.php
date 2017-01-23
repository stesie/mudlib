<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\PlayerId;

class PlayerWasCreatedDomainEvent implements DomainEvent
{
    /**
     * @var PlayerId
     */
    private $id;

    public function __construct(PlayerId $id)
    {
        $this->id = $id;
    }
}