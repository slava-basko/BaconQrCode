<?php

namespace BaconQrCode\Common;

use DASPRiD\Enum\AbstractEnum;

/**
 * Enum representing various modes in which data can be encoded to bits.
 *
 * @method static self TERMINATOR()
 * @method static self NUMERIC()
 * @method static self ALPHANUMERIC()
 * @method static self STRUCTURED_APPEND()
 * @method static self BYTE()
 * @method static self ECI()
 * @method static self KANJI()
 * @method static self FNC1_FIRST_POSITION()
 * @method static self FNC1_SECOND_POSITION()
 * @method static self HANZI()
 */
final class Mode extends AbstractEnum
{
    protected static $TERMINATOR = [[0, 0, 0], 0x00];
    protected static $NUMERIC = [[10, 12, 14], 0x01];
    protected static $ALPHANUMERIC = [[9, 11, 13], 0x02];
    protected static $STRUCTURED_APPEND = [[0, 0, 0], 0x03];
    protected static $BYTE = [[8, 16, 16], 0x04];
    protected static $ECI = [[0, 0, 0], 0x07];
    protected static $KANJI = [[8, 10, 12], 0x08];
    protected static $FNC1_FIRST_POSITION = [[0, 0, 0], 0x05];
    protected static $FNC1_SECOND_POSITION = [[0, 0, 0], 0x09];
    protected static $HANZI = [[8, 10, 12], 0x0d];

    /**
     * @var int[]
     */
    private $characterCountBitsForVersions;

    /**
     * @var int
     */
    private $bits;

    protected function __construct(array $characterCountBitsForVersions, $bits)
    {
        $this->characterCountBitsForVersions = $characterCountBitsForVersions;
        $this->bits = $bits;
    }

    /**
     * Returns the number of bits used in a specific QR code version.
     */
    public function getCharacterCountBits(Version $version)
    {
        $number = $version->getVersionNumber();

        if ($number <= 9) {
            $offset = 0;
        } elseif ($number <= 26) {
            $offset = 1;
        } else {
            $offset = 2;
        }

        return $this->characterCountBitsForVersions[$offset];
    }

    /**
     * Returns the four bits used to encode this mode.
     */
    public function getBits()
    {
        return $this->bits;
    }
}
