<?php

namespace BaconQrCode\Renderer\Eye;

use BaconQrCode\Renderer\Path\Path;

/**
 * Renders the inner eye as a circle.
 */
final class SimpleCircleEye implements EyeInterface
{
    /**
     * @var self|null
     */
    private static $instance;

    private function __construct()
    {
    }

    public static function instance()
    {
        return self::$instance ?: self::$instance = new self();
    }

    public function getExternalPath()
    {
        return (new Path())
            ->move(-3.5, -3.5)
            ->line(3.5, -3.5)
            ->line(3.5, 3.5)
            ->line(-3.5, 3.5)
            ->close()
            ->move(-2.5, -2.5)
            ->line(-2.5, 2.5)
            ->line(2.5, 2.5)
            ->line(2.5, -2.5)
            ->close()
        ;
    }

    public function getInternalPath()
    {
        return (new Path())
            ->move(1.5, 0)
            ->ellipticArc(1.5, 1.5, 0., false, true, 0., 1.5)
            ->ellipticArc(1.5, 1.5, 0., false, true, -1.5, 0.)
            ->ellipticArc(1.5, 1.5, 0., false, true, 0., -1.5)
            ->ellipticArc(1.5, 1.5, 0., false, true, 1.5, 0.)
            ->close()
        ;
    }
}
