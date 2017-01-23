<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\PlayerWasCreatedEvent;
use stesie\mudlib\ValueObject\PlayerId;

class Player
{
    use EventRecorder;

    /**
     * @var PlayerId
     */
    private $id;

    private function __construct(PlayerId $id)
    {
        $this->id = $id;
    }

    public static function create(PlayerId $id)
    {
        $inst = new static($id);
        $inst->recordEvent(new PlayerWasCreatedEvent($id));
        return $inst;
    }
}