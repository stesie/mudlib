<?php

namespace stesie\mudlib\Tools;
use stesie\mudlib\ValueObject\Point;

/**
 * Traversable, that iterates all Points around the given Point.
 */
class PointsAroundPointIterator implements \IteratorAggregate
{
    /**
     * @var Point
     */
    private $point;

    public function __construct(Point $point)
    {
        $this->point = $point;
    }

    public function getIterator(): \Iterator
    {
        $x = $this->point->getX();
        $y = $this->point->getY();

        yield Point::create($x    , $y - 1);
        yield Point::create($x + 1, $y - 1);
        yield Point::create($x + 1, $y    );
        yield Point::create($x + 1, $y + 1);
        yield Point::create($x    , $y + 1);
        yield Point::create($x - 1, $y + 1);
        yield Point::create($x - 1, $y    );
        yield Point::create($x - 1, $y - 1);
    }
}