<?php

namespace stesie\mudlib\Tools;
use stesie\mudlib\ValueObject\Area;
use stesie\mudlib\ValueObject\Point;

/**
 * Traversable, that iterates all Points around the given Area.
 */
class PointsAroundAreaIterator implements \IteratorAggregate
{
    /**
     * @var Area
     */
    private $area;

    public function __construct(Area $area)
    {
        $this->area = $area;
    }

    public function getIterator(): \Iterator
    {
        $top = $this->area->getOrigin()->getY() - 1;
        $bottom = $this->area->getOrigin()->getY() + $this->area->getHeight();
        $left = $this->area->getOrigin()->getX() - 1;
        $right = $this->area->getOrigin()->getX() + $this->area->getWidth();

        for ($x = $left + 1; $x < $right; $x++)
            yield Point::create($x, $top);
        
        for ($y = $top; $y < $bottom; $y++)
            yield Point::create($right, $y);
        
        for ($x = $right; $x > $left; $x--)
            yield Point::create($x, $bottom);
        
        for ($y = $bottom; $y >= $top; $y--)
            yield Point::create($left, $y);
    }    
}