<?php

namespace BaconQrCode\Renderer\Color;

use BaconQrCode\Exception;

final class Alpha implements ColorInterface
{
    /**
     * @var int
     */
    private $alpha;

    /**
     * @var ColorInterface
     */
    private $baseColor;

    /**
     * @param int $alpha the alpha value, 0 to 100
     */
    public function __construct($alpha, ColorInterface $baseColor)
    {
        if ($alpha < 0 || $alpha > 100) {
            throw new Exception\InvalidArgumentException('Alpha must be between 0 and 100');
        }

        $this->alpha = $alpha;
        $this->baseColor = $baseColor;
    }

    public function getAlpha()
    {
        return $this->alpha;
    }

    public function getBaseColor()
    {
        return $this->baseColor;
    }

    public function toRgb()
    {
        return $this->baseColor->toRgb();
    }

    public function toCmyk()
    {
        return $this->baseColor->toCmyk();
    }

    public function toGray()
    {
        return $this->baseColor->toGray();
    }
}
