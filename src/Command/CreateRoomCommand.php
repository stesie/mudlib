<?php

namespace stesie\mudlib\Command;

use stesie\mudlib\Entity\Room;
use stesie\mudlib\EventStore;
use stesie\mudlib\ValueObject\RoomId;

final class CreateRoomCommand
{
    /**
     * @var EventStore
     */
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function run()
    {
        $room = Room::create(RoomId::generate());

        $this->eventStore->storeEvents($room->getRecordedEvents());
        //$room->clearRecordedEvents();
    }
}