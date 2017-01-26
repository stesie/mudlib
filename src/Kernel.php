<?php

namespace stesie\mudlib;

use Predis\ClientInterface;
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
        $this->eventBus->subscribe(RoomWasCreatedEvent::class,
            [ new DungeonMapProjector($this->redis), 'handleRoomWasCreatedEvent' ]);
    }
}