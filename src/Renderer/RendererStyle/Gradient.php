<?php

namespace BaconQrCode\Renderer\RendererStyle;

use BaconQrCode\Renderer\Color\ColorInterface;

final class Gradient
{
    /**
     * @var ColorInterface
     */
    private $startColor;

    /**
     * @var ColorInterface
     */
    private $endColor;

    /**
     * @var GradientType
     */
    private $type;

    public function __construct(ColorInterface $startColor, ColorInterface $endColor, GradientType $type)
    {
        $this->startColor = $startColor;
        $this->endColor = $endColor;
        $this->type = $type;
    }

    public function getStartColor()
    {
        return $this->startColor;
    }

    public function getEndColor()
    {
        return $this->endColor;
    }

    public function getType()
    {
        return $this->type;
    }
}
