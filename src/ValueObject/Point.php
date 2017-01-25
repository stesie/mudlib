<?php

namespace stesie\mudlib\ValueObject;

final class Point
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    private function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function create(int $x, int $y): Point
    {
        return new static($x, $y);
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    function __toString(): string
    {
        return sprintf("Point(%u, %u)", $this->x, $this->y);
    }
}
