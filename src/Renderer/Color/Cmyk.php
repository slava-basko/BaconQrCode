<?php

namespace BaconQrCode\Renderer\Color;

use BaconQrCode\Exception;

final class Cmyk implements ColorInterface
{
    /**
     * @var int
     */
    private $cyan;

    /**
     * @var int
     */
    private $magenta;

    /**
     * @var int
     */
    private $yellow;

    /**
     * @var int
     */
    private $black;

    /**
     * @param int $cyan the cyan amount, 0 to 100
     * @param int $magenta the magenta amount, 0 to 100
     * @param int $yellow the yellow amount, 0 to 100
     * @param int $black the black amount, 0 to 100
     */
    public function __construct($cyan, $magenta, $yellow, $black)
    {
        if ($cyan < 0 || $cyan > 100) {
            throw new Exception\InvalidArgumentException('Cyan must be between 0 and 100');
        }

        if ($magenta < 0 || $magenta > 100) {
            throw new Exception\InvalidArgumentException('Magenta must be between 0 and 100');
        }

        if ($yellow < 0 || $yellow > 100) {
            throw new Exception\InvalidArgumentException('Yellow must be between 0 and 100');
        }

        if ($black < 0 || $black > 100) {
            throw new Exception\InvalidArgumentException('Black must be between 0 and 100');
        }

        $this->cyan = $cyan;
        $this->magenta = $magenta;
        $this->yellow = $yellow;
        $this->black = $black;
    }

    public function getCyan()
    {
        return $this->cyan;
    }

    public function getMagenta()
    {
        return $this->magenta;
    }

    public function getYellow()
    {
        return $this->yellow;
    }

    public function getBlack()
    {
        return $this->black;
    }

    public function toRgb()
    {
        $k = $this->black / 100;
        $c = (-$k * $this->cyan + $k * 100 + $this->cyan) / 100;
        $m = (-$k * $this->magenta + $k * 100 + $this->magenta) / 100;
        $y = (-$k * $this->yellow + $k * 100 + $this->yellow) / 100;

        return new Rgb(
            (int) (-$c * 255 + 255),
            (int) (-$m * 255 + 255),
            (int) (-$y * 255 + 255)
        );
    }

    public function toCmyk()
    {
        return $this;
    }

    public function toGray()
    {
        return $this->toRgb()->toGray();
    }
}
