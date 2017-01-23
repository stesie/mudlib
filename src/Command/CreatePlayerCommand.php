<?php

namespace stesie\mudlib\Command;

use stesie\mudlib\Entity\Player;
use stesie\mudlib\EventStore;
use stesie\mudlib\ValueObject\PlayerId;

final class CreatePlayerCommand
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
        $player = Player::create(PlayerId::generate());

        $this->eventStore->storeEvents($player->getRecordedEvents());
        //$player->clearRecordedEvents();
    }
}