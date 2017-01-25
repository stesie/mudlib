<?php

namespace stesie\mudlib;

use Predis\ClientInterface;

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
        //$this->eventBus->subscribe(RoomWasCreatedEvent::class, function() { echo "gotcha!"; });
    }
}