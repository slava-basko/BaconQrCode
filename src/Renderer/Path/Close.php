<?php

namespace BaconQrCode\Renderer\Path;

final class Close implements OperationInterface
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

    /**
     * @return self
     */
    public function translate($x, $y)
    {
        return $this;
    }
}
