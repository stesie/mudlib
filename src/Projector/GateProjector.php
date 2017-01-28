<?php

namespace stesie\mudlib\Projector;

use Predis\ClientInterface;
use stesie\mudlib\Event\MazeTileWasCreatedEvent;
use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\Tools\PointsAroundAreaIterator;
use stesie\mudlib\Tools\PointsAroundPointIterator;
use stesie\mudlib\ValueObject\DungeonMapTile;
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

    /**
     * @param Point[] $points
     * @return \Generator
     */
    private function findDungeonMapTiles($points): \Generator
    {
        $keys = array_map(function(Point $point) {
            return sprintf('dungeonMap$%s:%s', $point->getX(), $point->getY());
        }, $points);

        foreach($this->redis->mget($keys) as $i => $value) {
            $point = $points[$i];

            if ($value) {
                $dungeonMapTile = new DungeonMapTile();
                $dungeonMapTile->unserialize($value);
                yield $point => $dungeonMapTile;
            }
            else {
                yield $point => null;
            }
        }
    }

    public function handleRoomWasCreatedEvent(RoomWasCreatedEvent $domainEvent)
    {
        $points = iterator_to_array(new PointsAroundAreaIterator($domainEvent->getArea()));
        foreach($this->findDungeonMapTiles($points) as $point => $dungeonMapTile) {
            if (!$dungeonMapTile) {
                continue;  // ignore empty tile
            }

            if ('MazeTile' !== $dungeonMapTile->getUsage()) {
                continue;
            }

            $direction = $domainEvent->getArea()->directionOfPoint($point);

            $key = sprintf('gate$%s:%s', $domainEvent->getAggregateId()->getId(), $direction);
            $this->redis->set($key, serialize([
                'mazeTileId' => $dungeonMapTile->getAggregateId()->getId(),
            ]));
        }
    }

    public function handleMazeTileWasCreatedEvent(MazeTileWasCreatedEvent $domainEvent)
    {
        $points = iterator_to_array(new PointsAroundPointIterator($domainEvent->getPoint()));
        foreach($this->findDungeonMapTiles($points) as $point => $dungeonMapTile) {
            if (!$dungeonMapTile) {
                continue;  // ignore empty tile
            }

            if ('Room' !== $dungeonMapTile->getUsage()) {
                continue;
            }

            $direction = $point->directionOfPoint($domainEvent->getPoint());

            $key = sprintf('gate$%s:%s', $dungeonMapTile->getAggregateId()->getId(), $direction);
            $this->redis->set($key, serialize([
                'mazeTileId' => $domainEvent->getAggregateId()->getId(),
            ]));
        }
    }
}