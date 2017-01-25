<?php

namespace stesie\mudlib\Event;

use stesie\mudlib\ValueObject\Id;
use stesie\mudlib\ValueObject\PlayerId;

final class PlayerWasCreatedEvent implements DomainEventInterface
{
    /**
     * @var PlayerId
     */
    private $id;

    public function __construct(PlayerId $id)
    {
        $this->id = $id;
    }

    public function getAggregateId(): Id
    {
        return $this->id;
    }
}
