<?php

namespace stesie\mudlib\Command;

use stesie\mudlib\Entity\Player;
use stesie\mudlib\ValueObject\PlayerId;

class CreatePlayerCommand
{
    public function run()
    {
        $player = Player::create(PlayerId::generate());
    }
}