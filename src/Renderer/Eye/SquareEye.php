<?php

namespace BaconQrCode\Renderer\Eye;

use BaconQrCode\Renderer\Path\Path;

/**
 * Renders the eyes in their default square shape.
 */
final class SquareEye implements EyeInterface
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
            ->move(-1.5, -1.5)
            ->line(1.5, -1.5)
            ->line(1.5, 1.5)
            ->line(-1.5, 1.5)
            ->close()
        ;
    }
}
