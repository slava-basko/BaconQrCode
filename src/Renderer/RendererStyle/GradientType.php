<?php


namespace BaconQrCode\Renderer\RendererStyle;

use DASPRiD\Enum\AbstractEnum;

/**
 * @method static self VERTICAL()
 * @method static self HORIZONTAL()
 * @method static self DIAGONAL()
 * @method static self INVERSE_DIAGONAL()
 * @method static self RADIAL()
 */
final class GradientType extends AbstractEnum
{
    protected static $VERTICAL = null;
    protected static $HORIZONTAL = null;
    protected static $DIAGONAL = null;
    protected static $INVERSE_DIAGONAL = null;
    protected static $RADIAL = null;
}
