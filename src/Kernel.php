<?php

namespace stesie\mudlib;

use Predis\ClientInterface;
use stesie\mudlib\Event\MazeTileWasCreatedEvent;
use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\Projector\DungeonMapProjector;

class Kernel
{
    /**
     * @var EventBusInterface
     */
    private $eventBus;

    /**
     * @var ClientInterface
     */
    private $redis;

    public function __construct(EventBusInterface $eventBus, ClientInterface $redis)
    {
        $this->eventBus = $eventBus;
        $this->redis = $redis;
    }

    public function boot()
    {
        $dungeonMapProjector = new DungeonMapProjector($this->redis);

        $this->eventBus->subscribe(RoomWasCreatedEvent::class, [$dungeonMapProjector, 'handleRoomWasCreatedEvent' ]);
        $this->eventBus->subscribe(MazeTileWasCreatedEvent::class, [$dungeonMapProjector, 'handleMazeTileWasCreatedEvent' ]);
    }
}