<?php

namespace stesie\mudlib\Projector;

use Predis\ClientInterface;
use stesie\mudlib\Event\MazeTileWasCreatedEvent;
use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\Tools\PointsAroundAreaIterator;
use stesie\mudlib\Tools\PointsAroundPointIterator;
use stesie\mudlib\ValueObject\Point;

class GateProjector
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
        // iterate tiles around room
        /** @var Point[] $pointsAroundRoom */
        $pointsAroundRoom = iterator_to_array(new PointsAroundAreaIterator($domainEvent->getArea()));
        $keys = array_map(function(Point $point) {
            return sprintf('dungeonMap$%s:%s', $point->getX(), $point->getY());
        }, $pointsAroundRoom);

        // find maze tiles
        foreach($this->redis->mget($keys) as $i => $value) {
            $point = $pointsAroundRoom[$i];

            if (!$value) {
                continue;  // ignore empty tile
            }

            $value = unserialize($value);

            if ('MazeTile' !== $value['usage']) {
                continue;
            }

            $direction = $domainEvent->getArea()->directionOfPoint($point);

            $key = sprintf('gate$%s:%s', $domainEvent->getAggregateId()->getId(), $direction);
            $this->redis->set($key, serialize([
                'mazeTileId' => $value['aggregateId'],
            ]));
        }
    }

    public function handleMazeTileWasCreatedEvent(MazeTileWasCreatedEvent $domainEvent)
    {
        // iterate around maze tile to find a room
        /** @var Point[] $pointsAroundPoint */
        $pointsAroundPoint = iterator_to_array(new PointsAroundPointIterator($domainEvent->getPoint()));
        $keys = array_map(function(Point $point) {
            return sprintf('dungeonMap$%s:%s', $point->getX(), $point->getY());
        }, $pointsAroundPoint);

        // find room tiles
        foreach($this->redis->mget($keys) as $i => $value) {
            $point = $pointsAroundPoint[$i];

            if (!$value) {
                continue;  // ignore empty tile
            }

            $value = unserialize($value);

            if ('Room' !== $value['usage']) {
                continue;
            }

            $direction = $point->directionOfPoint($domainEvent->getPoint());

            $key = sprintf('gate$%s:%s', $value['aggregateId'], $direction);
            $this->redis->set($key, serialize([
                'mazeTileId' => $domainEvent->getAggregateId()->getId(),
            ]));
        }
    }
}