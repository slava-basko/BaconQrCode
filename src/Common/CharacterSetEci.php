<?php

namespace BaconQrCode\Common;

use BaconQrCode\Exception\InvalidArgumentException;
use DASPRiD\Enum\AbstractEnum;

/**
 * Encapsulates a Character Set ECI, according to "Extended Channel Interpretations" 5.3.1.1 of ISO 18004.
 */
final class CharacterSetEci extends AbstractEnum
{
    protected static $CP437 = [[0, 2]];
    protected static $ISO8859_1 = [[1, 3], 'ISO-8859-1'];
    protected static $ISO8859_2 = [[4], 'ISO-8859-2'];
    protected static $ISO8859_3 = [[5], 'ISO-8859-3'];
    protected static $ISO8859_4 = [[6], 'ISO-8859-4'];
    protected static $ISO8859_5 = [[7], 'ISO-8859-5'];
    protected static $ISO8859_6 = [[8], 'ISO-8859-6'];
    protected static $ISO8859_7 = [[9], 'ISO-8859-7'];
    protected static $ISO8859_8 = [[10], 'ISO-8859-8'];
    protected static $ISO8859_9 = [[11], 'ISO-8859-9'];
    protected static $ISO8859_10 = [[12], 'ISO-8859-10'];
    protected static $ISO8859_11 = [[13], 'ISO-8859-11'];
    protected static $ISO8859_12 = [[14], 'ISO-8859-12'];
    protected static $ISO8859_13 = [[15], 'ISO-8859-13'];
    protected static $ISO8859_14 = [[16], 'ISO-8859-14'];
    protected static $ISO8859_15 = [[17], 'ISO-8859-15'];
    protected static $ISO8859_16 = [[18], 'ISO-8859-16'];
    protected static $SJIS = [[20], 'Shift_JIS'];
    protected static $CP1250 = [[21], 'windows-1250'];
    protected static $CP1251 = [[22], 'windows-1251'];
    protected static $CP1252 = [[23], 'windows-1252'];
    protected static $CP1256 = [[24], 'windows-1256'];
    protected static $UNICODE_BIG_UNMARKED = [[25], 'UTF-16BE', 'UnicodeBig'];
    protected static $UTF8 = [[26], 'UTF-8'];
    protected static $ASCII = [[27, 170], 'US-ASCII'];
    protected static $BIG5 = [[28]];
    protected static $GB18030 = [[29], 'GB2312', 'EUC_CN', 'GBK'];
    protected static $EUC_KR = [[30], 'EUC-KR'];

    /**
     * @var int[]
     */
    private $values;

    /**
     * @var string[]
     */
    private $otherEncodingNames;

    /**
     * @var array<int, self>|null
     */
    private static $valueToEci;

    /**
     * @var array<string, self>|null
     */
    private static $nameToEci;

    /**
     * @param array $values
     * @param ...string $otherEncodingNames
     */
    public function __construct()
    {
        $args = func_get_args();
        $this->values = array_shift($args);
        $this->otherEncodingNames = $args;
    }

    /**
     * Returns the primary value.
     */
    public function getValue()
    {
        return $this->values[0];
    }

    /**
     * Gets character set ECI by value.
     *
     * Returns the representing ECI of a given value, or null if it is legal but unsupported.
     *
     * @throws InvalidArgumentException if value is not between 0 and 900
     */
    public static function getCharacterSetEciByValue($value)
    {
        if ($value < 0 || $value >= 900) {
            throw new InvalidArgumentException('Value must be between 0 and 900');
        }

        $valueToEci = self::valueToEci();

        if (! array_key_exists($value, $valueToEci)) {
            return null;
        }

        return $valueToEci[$value];
    }

    /**
     * Returns character set ECI by name.
     *
     * Returns the representing ECI of a given name, or null if it is legal but unsupported
     */
    public static function getCharacterSetEciByName($name)
    {
        $nameToEci = self::nameToEci();
        $name = strtolower($name);

        if (! array_key_exists($name, $nameToEci)) {
            return null;
        }

        return $nameToEci[$name];
    }

    private static function valueToEci()
    {
        if (null !== self::$valueToEci) {
            return self::$valueToEci;
        }

        self::$valueToEci = [];

        foreach (self::values() as $eci) {
            foreach ($eci->values as $value) {
                self::$valueToEci[$value] = $eci;
            }
        }

        return self::$valueToEci;
    }

    private static function nameToEci()
    {
        if (null !== self::$nameToEci) {
            return self::$nameToEci;
        }

        self::$nameToEci = [];

        foreach (self::values() as $eci) {
            self::$nameToEci[strtolower($eci->name())] = $eci;

            foreach ($eci->otherEncodingNames as $name) {
                self::$nameToEci[strtolower($name)] = $eci;
            }
        }

        return self::$nameToEci;
    }
}
