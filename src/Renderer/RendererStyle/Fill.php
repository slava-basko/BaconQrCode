<?php

namespace BaconQrCode\Renderer\RendererStyle;

use BaconQrCode\Exception\RuntimeException;
use BaconQrCode\Renderer\Color\ColorInterface;
use BaconQrCode\Renderer\Color\Gray;

final class Fill
{
    /**
     * @var ColorInterface
     */
    private $backgroundColor;

    /**
     * @var ColorInterface|null
     */
    private $foregroundColor;

    /**
     * @var Gradient|null
     */
    private $foregroundGradient;

    /**
     * @var EyeFill
     */
    private $topLeftEyeFill;

    /**
     * @var EyeFill
     */
    private $topRightEyeFill;

    /**
     * @var EyeFill
     */
    private $bottomLeftEyeFill;

    /**
     * @var self|null
     */
    private static $default;

    private function __construct(
        ColorInterface $backgroundColor,
        $foregroundColor,
        $foregroundGradient,
        EyeFill $topLeftEyeFill,
        EyeFill $topRightEyeFill,
        EyeFill $bottomLeftEyeFill
    ) {
        $this->backgroundColor = $backgroundColor;
        $this->foregroundColor = $foregroundColor;
        $this->foregroundGradient = $foregroundGradient;
        $this->topLeftEyeFill = $topLeftEyeFill;
        $this->topRightEyeFill = $topRightEyeFill;
        $this->bottomLeftEyeFill = $bottomLeftEyeFill;
    }

    public static function _default()
    {
        return self::$default ?: self::$default = self::uniformColor(new Gray(100), new Gray(0));
    }

    public static function withForegroundColor(
        ColorInterface $backgroundColor,
        ColorInterface $foregroundColor,
        EyeFill $topLeftEyeFill,
        EyeFill $topRightEyeFill,
        EyeFill $bottomLeftEyeFill
    ) {
        return new self(
            $backgroundColor,
            $foregroundColor,
            null,
            $topLeftEyeFill,
            $topRightEyeFill,
            $bottomLeftEyeFill
        );
    }

    public static function withForegroundGradient(
        ColorInterface $backgroundColor,
        Gradient $foregroundGradient,
        EyeFill $topLeftEyeFill,
        EyeFill $topRightEyeFill,
        EyeFill $bottomLeftEyeFill
    ) {
        return new self(
            $backgroundColor,
            null,
            $foregroundGradient,
            $topLeftEyeFill,
            $topRightEyeFill,
            $bottomLeftEyeFill
        );
    }

    public static function uniformColor(ColorInterface $backgroundColor, ColorInterface $foregroundColor)
    {
        return new self(
            $backgroundColor,
            $foregroundColor,
            null,
            EyeFill::inherit(),
            EyeFill::inherit(),
            EyeFill::inherit()
        );
    }

    public static function uniformGradient(ColorInterface $backgroundColor, Gradient $foregroundGradient)
    {
        return new self(
            $backgroundColor,
            null,
            $foregroundGradient,
            EyeFill::inherit(),
            EyeFill::inherit(),
            EyeFill::inherit()
        );
    }

    public function hasGradientFill()
    {
        return null !== $this->foregroundGradient;
    }

    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    public function getForegroundColor()
    {
        if (null === $this->foregroundColor) {
            throw new RuntimeException('Fill uses a gradient, thus no foreground color is available');
        }

        return $this->foregroundColor;
    }

    public function getForegroundGradient()
    {
        if (null === $this->foregroundGradient) {
            throw new RuntimeException('Fill uses a single color, thus no foreground gradient is available');
        }

        return $this->foregroundGradient;
    }

    public function getTopLeftEyeFill()
    {
        return $this->topLeftEyeFill;
    }

    public function getTopRightEyeFill()
    {
        return $this->topRightEyeFill;
    }

    public function getBottomLeftEyeFill()
    {
        return $this->bottomLeftEyeFill;
    }
}
