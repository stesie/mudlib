<?php

namespace stesie\mudlib\Command;

use stesie\mudlib\Entity\Room;
use stesie\mudlib\ValueObject\RoomId;

class CreateRoomCommand
{
    public function run()
    {
        $room = Room::create(RoomId::generate());
    }
}