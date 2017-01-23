<?php

namespace stesie\mudlib\Event;


use stesie\mudlib\ValueObject\PlayerId;

class PlayerNicknameChangedEvent implements Event
{
    /**
     * @var PlayerId
     */
    private $id;

    /**
     * @var string
     */
    private $nickname;

    public function __construct(PlayerId $id, string $nickname)
    {
        $this->id = $id;
        $this->nickname = $nickname;
    }
}