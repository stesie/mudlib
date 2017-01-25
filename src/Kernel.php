<?php

namespace stesie\mudlib;

class Kernel
{
    /**
     * @var EventBusInterface
     */
    private $eventBus;

    public function __construct(EventBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function boot()
    {
        //$this->eventBus->subscribe(RoomWasCreatedEvent::class, function() { echo "gotcha!"; });
    }
}