<?php

namespace stesie\mudlib\ValueObject;

/**
 * Simple area class, that resembles a collection of enclosed Point objects, that may be traversed.
 */
final class Area implements \IteratorAggregate
{
    /**
     * @var Point
     */
    private $origin;

    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    private function __construct(Point $origin, int $width, int $height)
    {
        if ($width < 1) {
            throw new \InvalidArgumentException('$width must be a positive integer');
        }

        if ($height < 1) {
            throw new \InvalidArgumentException('$width must be a positive integer');
        }

        $this->origin = $origin;
        $this->width = $width;
        $this->height = $height;
    }

    public static function createFromPoint(Point $origin, int $width, int $height): Area
    {
        return new static($origin, $width, $height);
    }

    public static function createFromCoordinates(int $x, int $y, int $width, int $height): Area
    {
        return new static(Point::create($x, $y), $width, $height);
    }

    public function getOrigin(): Point
    {
        return $this->origin;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function __toString(): string
    {
        return sprintf("Area[%ux%u+%u+%u", $this->width, $this->height, $this->origin->getX(), $this->origin->getY());
    }

    public function getIterator(): \Iterator
    {
        $minY = $this->origin->getY();
        $maxY = $this->getBottomEdgeY();
        $minX = $this->getOrigin()->getX();
        $maxX = $this->getRightEdgeX();

        for ($y = $minY; $y <= $maxY; $y++) {
            for ($x = $minX; $x <= $maxX; $x++) {
                yield Point::create($x, $y);
            }
        }
    }

    public function directionOfPoint(Point $point)
    {
        if ($point->getX() > $this->getRightEdgeX())
            return 'east';

        if ($point->getY() > $this->getBottomEdgeY())
            return 'south';

        if ($point->getX() < $this->origin->getX())
            return 'west';

        if ($point->getY() < $this->origin->getY())
            return 'north';

        throw new \LogicException('Point is within Area');
    }

    private function getRightEdgeX(): int
    {
        return $this->getOrigin()->getX() + $this->width - 1;
    }

    private function getBottomEdgeY(): int
    {
        return $this->origin->getY() + $this->height - 1;
    }
}
