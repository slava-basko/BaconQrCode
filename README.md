# QR Code generator

## Introduction
BaconQrCode is a port of QR code portion of the ZXing library. It currently
only features the encoder part, but could later receive the decoder part as
well.

As the Reed Solomon codec implementation of the ZXing library performs quite
slow in PHP, it was exchanged with the implementation by Phil Karn.


## Example usage
```php
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

$renderer = new ImageRenderer(
    new RendererStyle(400),
    new ImagickImageBackEnd()
);
$writer = new Writer($renderer);
$writer->writeFile('Hello World!', 'qrcode.png');
```

## Available image renderer back ends
BaconQrCode comes with multiple back ends for rendering images. Currently included are the following:

- `ImagickImageBackEnd`: renders raster images using the Imagick library
- `SvgImageBackEnd`: renders SVG files using XMLWriter
- `EpsImageBackEnd`: renders EPS files

### How to run tests
Install dependencies
```shell
docker run -v `pwd`:/var/www --rm feitosa/php55-with-composer composer install
```

Run tests
```shell
docker run -v `pwd`:/var/www --rm feitosa/php55-with-composer vendor/bin/phpunit
```
