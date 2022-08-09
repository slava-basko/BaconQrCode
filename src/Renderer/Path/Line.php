<?php

namespace BaconQrCode\Renderer\Path;

final class Line implements OperationInterface
{
    /**
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    /**
     * @return self
     */
    public function translate($x, $y)
    {
        return new self($this->x + $x, $this->y + $y);
    }
}
