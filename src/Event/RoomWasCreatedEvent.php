<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Area;
use stesie\mudlib\ValueObject\AbstractId;
use stesie\mudlib\ValueObject\RoomId;

final class RoomWasCreatedEvent implements DomainEventInterface
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

    public function getAggregateId(): AbstractId
    {
        return $this->id;
    }

    public function getArea(): Area
    {
        return $this->area;
    }
}
