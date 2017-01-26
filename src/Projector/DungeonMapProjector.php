<?php

namespace stesie\mudlib\Projector;

use Predis\ClientInterface;
use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\ValueObject\Point;

class DungeonMapProjector
{
    /**
     * @var ClientInterface
     */
    private $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
    }

    public function handleRoomWasCreatedEvent(RoomWasCreatedEvent $domainEvent)
    {
        $this->markRoomsAreaInMap($domainEvent);
    }

    private function markRoomsAreaInMap(RoomWasCreatedEvent $domainEvent)
    {
        $value = serialize([
            'usage' => 'Room',
            'aggregateId' => $domainEvent->getAggregateId()->getId(),
        ]);

        foreach($domainEvent->getArea() as $point) {
            /** @var Point $point */
            $key = sprintf('dungeonMap$%s:%s', $point->getX(), $point->getY());
            $this->redis->set($key, $value);
        }
    }
}