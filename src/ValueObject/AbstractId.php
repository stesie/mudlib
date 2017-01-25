<?php

namespace stesie\mudlib\ValueObject;

abstract class AbstractId
{
    /**
     * @var string
     */
    private $id;

    private function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromString(string $id)
    {
        return new static($id);
    }

    public static function generate()
    {
        // @todo generate real id
        return new static(uniqid());
    }

    public function __toString(): string
    {
        return $this->id;
    }
}