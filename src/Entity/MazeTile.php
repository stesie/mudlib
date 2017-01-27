<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\MazeTileWasCreatedEvent;
use stesie\mudlib\ValueObject\Point;
use stesie\mudlib\ValueObject\MazeTileId;

final class MazeTile
{
    use EventRecorderTrait;

    /**
     * @var MazeTileId
     */
    private $id;

    /**
     * @var Point
     */
    private $point;

    private function __construct(MazeTileId $id, Point $point)
    {
        $this->id = $id;
        $this->point = $point;
    }

    public static function create(MazeTileId $id, Point $point)
    {
        $inst = new static($id, $point);
        $inst->recordThat(new MazeTileWasCreatedEvent($id, $point));
        return $inst;
    }

    public function getId(): MazeTileId
    {
        return $this->id;
    }

    public function getPoint(): Point
    {
        return $this->point;
    }
}
