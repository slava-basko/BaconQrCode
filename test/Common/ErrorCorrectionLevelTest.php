<?php

namespace BaconQrCodeTest\Common;

use BaconQrCode\Common\ErrorCorrectionLevel;
use BaconQrCode\Exception\OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class ErrorCorrectionLevelTest extends TestCase
{
    public function testBitsMatchConstants()
    {
        $this->assertSame(0x0, ErrorCorrectionLevel::M()->getBits());
        $this->assertSame(0x1, ErrorCorrectionLevel::L()->getBits());
        $this->assertSame(0x2, ErrorCorrectionLevel::H()->getBits());
        $this->assertSame(0x3, ErrorCorrectionLevel::Q()->getBits());
    }

    public function testInvalidErrorCorrectionLevelThrowsException()
    {
        $this->setExpectedException(OutOfBoundsException::class);
        ErrorCorrectionLevel::forBits(4);
    }
}
