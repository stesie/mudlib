<?php

namespace stesie\mudlib\Command;

use stesie\mudlib\Entity\Player;
use stesie\mudlib\EventStoreInterface;
use stesie\mudlib\ValueObject\PlayerId;

final class CreatePlayerCommand
{
    /**
     * @var EventStoreInterface
     */
    private $eventStore;

    public function __construct(EventStoreInterface $eventStore)
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