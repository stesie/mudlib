<?php

namespace stesie\mudlib\ValueObject;

final class DungeonMapTile implements \Serializable
{
    /**
     * @var string
     */
    private $usage;

    /**
     * @var AbstractId
     */
    private $aggregateId;

    public function getUsage(): string
    {
        return $this->usage;
    }

    public function setUsage(string $usage): DungeonMapTile
    {
        $this->usage = $usage;
        return $this;
    }

    public function getAggregateId(): AbstractId
    {
        return $this->aggregateId;
    }

    public function setAggregateId(AbstractId $aggregateId): DungeonMapTile
    {
        $this->aggregateId = $aggregateId;
        return $this;
    }

    public function serialize(): string
    {
        return \serialize([
            'usage' => $this->usage,
            'aggregateId' => $this->aggregateId->getId(),
        ]);
    }

    public function unserialize($serialized)
    {
        $data = \unserialize($serialized);
        $this->usage = $data['usage'];

        switch ($this->usage) {
            case 'Room':
                $this->aggregateId = RoomId::fromString($data['aggregateId']);
                break;

            case 'MazeTile':
                $this->aggregateId = MazeTileId::fromString($data['aggregateId']);
                break;

            default:
                throw new \UnexpectedValueException('Unexpected "usage" value');
        }
    }
}
