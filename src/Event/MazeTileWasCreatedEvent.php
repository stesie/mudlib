<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Point;
use stesie\mudlib\ValueObject\AbstractId;
use stesie\mudlib\ValueObject\MazeTileId;

final class MazeTileWasCreatedEvent implements DomainEventInterface
{
    /**
     * @var MazeTileId
     */
    private $id;

    /**
     * @var Point
     */
    private $point;

    public function __construct(MazeTileId $id, Point $point)
    {
        $this->id = $id;
        $this->point = $point;
    }

    public function getAggregateId(): AbstractId
    {
        return $this->id;
    }

    public function getPoint(): Point
    {
        return $this->point;
    }
}
