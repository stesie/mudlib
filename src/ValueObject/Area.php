<?php

namespace stesie\mudlib\ValueObject;

class Area
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

    function __toString(): string
    {
        return sprintf("Area[%ux%u+%u+%u", $this->width, $this->height, $this->origin->getX(), $this->origin->getY());
    }
}