<?php

namespace BaconQrCodeTest\Integration;

use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Eye\SquareEye;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Module\SquareModule;
use BaconQrCode\Renderer\RendererStyle\EyeFill;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\Gradient;
use BaconQrCode\Renderer\RendererStyle\GradientType;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PHPUnit\Framework\TestCase;

final class ImagickRenderingTest extends TestCase
{
    public function testGenericQrCode()
    {
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        $tempName = tempnam(sys_get_temp_dir(), 'test') . '.png';
        $writer->writeFile('Hello World!', $tempName);

        $this->assertFileEquals(__DIR__.'/files/ImagickRenderingTest__testGenericQrCode__1.png', $tempName);
        unlink($tempName);
    }

    public function testIssue79()
    {
        $eye = SquareEye::instance();
        $squareModule = SquareModule::instance();

        $eyeFill = new EyeFill(new Rgb(100, 100, 55), new Rgb(100, 100, 255));
        $gradient = new Gradient(new Rgb(100, 100, 55), new Rgb(100, 100, 255), GradientType::HORIZONTAL());

        $renderer = new ImageRenderer(
            new RendererStyle(
                400,
                2,
                $squareModule,
                $eye,
                Fill::withForegroundGradient(new Rgb(255, 255, 255), $gradient, $eyeFill, $eyeFill, $eyeFill)
            ),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        $tempName = tempnam(sys_get_temp_dir(), 'test') . '.png';
        $writer->writeFile('https://apiroad.net/very-long-url', $tempName);

        $this->assertFileEquals(__DIR__.'/files/ImagickRenderingTest__testIssue79__1.png', $tempName);
        unlink($tempName);
    }
}
