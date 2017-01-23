<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\PlayerId;

class PlayerWasCreatedEvent implements Event
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