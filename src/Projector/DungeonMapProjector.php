<?php

namespace stesie\mudlib\Projector;

use Predis\ClientInterface;
use stesie\mudlib\Event\MazeTileWasCreatedEvent;
use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\ValueObject\DungeonMapTile;
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

    public function handleMazeTileWasCreatedEvent(MazeTileWasCreatedEvent $domainEvent)
    {
        $point = $domainEvent->getPoint();
        $value = (new DungeonMapTile())
            ->setUsage('MazeTile')
            ->setAggregateId($domainEvent->getAggregateId())
            ->serialize();

        $key = sprintf('dungeonMap$%s:%s', $point->getX(), $point->getY());
        $this->redis->set($key, $value);
    }

    private function markRoomsAreaInMap(RoomWasCreatedEvent $domainEvent)
    {
        $value = (new DungeonMapTile())
            ->setUsage('Room')
            ->setAggregateId($domainEvent->getAggregateId())
            ->serialize();

        foreach($domainEvent->getArea() as $point) {
            /** @var Point $point */
            $key = sprintf('dungeonMap$%s:%s', $point->getX(), $point->getY());
            $this->redis->set($key, $value);
        }
    }
}