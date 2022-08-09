<?php

namespace BaconQrCode\Renderer\Path;

interface OperationInterface
{
    /**
     * Translates the operation's coordinates.
     */
    public function translate($x, $y);
}
