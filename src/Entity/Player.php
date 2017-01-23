<?php

namespace stesie\mudlib\Entity;

use stesie\mudlib\Event\PlayerNicknameChangedDomainEvent;
use stesie\mudlib\Event\PlayerWasCreatedDomainEvent;
use stesie\mudlib\ValueObject\PlayerId;

class Player implements RecordsEvents
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
        $inst->recordThat(new PlayerWasCreatedDomainEvent($id));
        return $inst;
    }

    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
        $this->recordThat(new PlayerNicknameChangedDomainEvent($this->id, $nickname));
    }
}