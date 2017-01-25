<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Area;
use stesie\mudlib\ValueObject\Id;
use stesie\mudlib\ValueObject\RoomId;

final class RoomWasCreatedEvent implements DomainEvent
{
    /**
     * @var RoomId
     */
    private $id;

    /**
     * @var Area
     */
    private $area;

    public function __construct(RoomId $id, Area $area)
    {
        $this->id = $id;
        $this->area = $area;
    }

    public function getAggregateId(): Id
    {
        return $this->id;
    }

    public function getArea(): Area
    {
        return $this->area;
    }
}
