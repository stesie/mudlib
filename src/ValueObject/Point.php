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

    public function directionOfPoint(Point $point)
    {
        if ($point->x > $this->x)
            return 'east';

        if ($point->y > $this->y)
            return 'south';

        if ($point->x < $this->x)
            return 'west';

        if ($point->y < $this->y)
            return 'north';

        throw new \LogicException('Points are equal');
    }
}
