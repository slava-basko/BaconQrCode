<?php

namespace BaconQrCode\Renderer\RendererStyle;

use BaconQrCode\Exception\RuntimeException;
use BaconQrCode\Renderer\Color\ColorInterface;

final class EyeFill
{
    /**
     * @var ColorInterface|null
     */
    private $externalColor;

    /**
     * @var ColorInterface|null
     */
    private $internalColor;

    /**
     * @var self|null
     */
    private static $inherit;

    /**
     * @param ColorInterface $externalColor
     * @param ColorInterface $internalColor
     */
    public function __construct($externalColor, $internalColor)
    {
        $this->externalColor = $externalColor;
        $this->internalColor = $internalColor;
    }

    public static function uniform(ColorInterface $color)
    {
        return new self($color, $color);
    }

    public static function inherit()
    {
        return self::$inherit ?: self::$inherit = new self(null, null);
    }

    public function inheritsBothColors()
    {
        return null === $this->externalColor && null === $this->internalColor;
    }

    public function inheritsExternalColor()
    {
        return null === $this->externalColor;
    }

    public function inheritsInternalColor()
    {
        return null === $this->internalColor;
    }

    public function getExternalColor()
    {
        if (null === $this->externalColor) {
            throw new RuntimeException('External eye color inherits foreground color');
        }

        return $this->externalColor;
    }

    public function getInternalColor()
    {
        if (null === $this->internalColor) {
            throw new RuntimeException('Internal eye color inherits foreground color');
        }

        return $this->internalColor;
    }
}
