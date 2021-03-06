<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\AbstractId;
use stesie\mudlib\ValueObject\PlayerId;

final class PlayerNicknameChangedEvent implements DomainEventInterface
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

    public function getAggregateId(): AbstractId
    {
        return $this->id;
    }

    public function getNickname(): string
    {
        return $this->nickname;
    }
}
