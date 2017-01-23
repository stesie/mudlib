<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\ValueObject\RoomId;

class Room
{
    use EventRecorder;

    /**
     * @var RoomId
     */
    private $id;

    private function __construct(RoomId $id)
    {
        $this->id = $id;
    }

    public static function create(RoomId $id)
    {
        $inst = new static($id);
        $inst->recordEvent(new RoomWasCreatedEvent($id));
        return $inst;
    }
}