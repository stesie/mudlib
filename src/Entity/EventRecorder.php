<?php

namespace stesie\mudlib\Entity;


use stesie\mudlib\Event\Event;

trait EventRecorder
{
    private $recordedEvents = [];

    private function recordEvent(Event $event)
    {
        $this->recordedEvents[] = $event;
    }
}