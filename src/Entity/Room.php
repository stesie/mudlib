<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\RoomWasCreatedEvent;
use stesie\mudlib\ValueObject\Area;
use stesie\mudlib\ValueObject\RoomId;

final class Room
{
    use EventRecorderTrait;

    /**
     * @var RoomId
     */
    private $id;

    /**
     * @var Area
     */
    private $area;

    private function __construct(RoomId $id, Area $area)
    {
        $this->id = $id;
        $this->area = $area;
    }

    public static function create(RoomId $id, Area $area)
    {
        $inst = new static($id, $area);
        $inst->recordThat(new RoomWasCreatedEvent($id, $area));
        return $inst;
    }

    public function getId(): RoomId
    {
        return $this->id;
    }

    public function getArea(): Area
    {
        return $this->area;
    }
}
