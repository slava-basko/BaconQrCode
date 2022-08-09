<?php

namespace BaconQrCode\Renderer\Color;

interface ColorInterface
{
    /**
     * Converts the color to RGB.
     */
    public function toRgb();

    /**
     * Converts the color to CMYK.
     */
    public function toCmyk();

    /**
     * Converts the color to gray.
     */
    public function toGray();
}
