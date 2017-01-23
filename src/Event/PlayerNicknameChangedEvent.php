<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Id;
use stesie\mudlib\ValueObject\PlayerId;

class PlayerNicknameChangedDomainEvent implements DomainEvent
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

    public function getAggregateId(): Id
    {
        return $this->id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }
}