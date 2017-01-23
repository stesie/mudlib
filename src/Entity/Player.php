<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\PlayerNicknameChangedEvent;
use stesie\mudlib\Event\PlayerWasCreatedEvent;
use stesie\mudlib\ValueObject\PlayerId;

class Player
{
    use EventRecorder;

    /**
     * @var PlayerId
     */
    private $id;

    /**
     * @var string
     */
    private $nickname;

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

    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
        $this->recordEvent(new PlayerNicknameChangedEvent($this->id, $nickname));
    }
}