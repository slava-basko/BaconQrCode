<?php

namespace BaconQrCode\Common;

use BaconQrCode\Exception\OutOfBoundsException;
use DASPRiD\Enum\AbstractEnum;

/**
 * Enum representing the four error correction levels.
 *
 * @method static self L() ~7% correction
 * @method static self M() ~15% correction
 * @method static self Q() ~25% correction
 * @method static self H() ~30% correction
 */
final class ErrorCorrectionLevel extends AbstractEnum
{
    protected static $L = [0x01];
    protected static $M = [0x00];
    protected static $Q = [0x03];
    protected static $H = [0x02];

    /**
     * @var int
     */
    private $bits;

    protected function __construct($bits)
    {
        $this->bits = $bits;
    }

    /**
     * @throws OutOfBoundsException if number of bits is invalid
     */
    public static function forBits($bits)
    {
        switch ($bits) {
            case 0:
                return self::M();

            case 1:
                return self::L();

            case 2:
                return self::H();

            case 3:
                return self::Q();
        }

        throw new OutOfBoundsException('Invalid number of bits');
    }

    /**
     * Returns the two bits used to encode this error correction level.
     */
    public function getBits()
    {
        return $this->bits;
    }
}
