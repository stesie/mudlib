<?php

namespace stesie\mudlib\Command;

use stesie\mudlib\Entity\MazeTile;
use stesie\mudlib\EventStoreInterface;
use stesie\mudlib\ValueObject\Point;
use stesie\mudlib\ValueObject\MazeTileId;

final class CreateMazeTileCommand
{
    /**
     * @var EventStoreInterface
     */
    private $eventStore;

    public function __construct(EventStoreInterface $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function run(Point $point): MazeTile
    {
        $mazeTile = MazeTile::create(MazeTileId::generate(), $point);

        $this->eventStore->storeEvents($mazeTile->getRecordedEvents());
        $mazeTile->clearRecordedEvents();

        return $mazeTile;
    }
}