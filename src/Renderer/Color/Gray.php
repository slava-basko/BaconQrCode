<?php

namespace BaconQrCode\Renderer\Color;

use BaconQrCode\Exception;

final class Gray implements ColorInterface
{
    /**
     * @var int
     */
    private $gray;

    /**
     * @param int $gray the gray value between 0 (black) and 100 (white)
     */
    public function __construct($gray)
    {
        if ($gray < 0 || $gray > 100) {
            throw new Exception\InvalidArgumentException('Gray must be between 0 and 100');
        }

        $this->gray = (int) $gray;
    }

    public function getGray()
    {
        return $this->gray;
    }

    public function toRgb()
    {
        return new Rgb((int) ($this->gray * 2.55), (int) ($this->gray * 2.55), (int) ($this->gray * 2.55));
    }

    public function toCmyk()
    {
        return new Cmyk(0, 0, 0, 100 - $this->gray);
    }

    public function toGray()
    {
        return $this;
    }
}
