<?php

namespace BaconQrCode\Renderer;

use BaconQrCode\Encoder\QrCode;

interface RendererInterface
{
    public function render(QrCode $qrCode);
}
