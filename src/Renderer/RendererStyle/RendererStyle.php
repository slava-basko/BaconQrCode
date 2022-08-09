<?php

namespace BaconQrCode\Renderer\RendererStyle;

use BaconQrCode\Renderer\Eye\EyeInterface;
use BaconQrCode\Renderer\Eye\ModuleEye;
use BaconQrCode\Renderer\Module\ModuleInterface;
use BaconQrCode\Renderer\Module\SquareModule;

final class RendererStyle
{
    /**
     * @var int
     */
    private $size;

    /**
     * @var int
     */
    private $margin;

    /**
     * @var ModuleInterface
     */
    private $module;

    /**
     * @var EyeInterface|null
     */
    private $eye;

    /**
     * @var Fill
     */
    private $fill;

    public function __construct(
        $size,
        $margin = 4,
        $module = null,
        $eye = null,
        $fill = null
    ) {
        $this->margin = $margin;
        $this->size = $size;
        $this->module = $module ?: SquareModule::instance();
        $this->eye = $eye ?: new ModuleEye($this->module);
        $this->fill = $fill ?: Fill::_default();
    }

    public function withSize($size)
    {
        $style = clone $this;
        $style->size = $size;
        return $style;
    }

    public function withMargin($margin)
    {
        $style = clone $this;
        $style->margin = $margin;
        return $style;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getMargin()
    {
        return $this->margin;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getEye()
    {
        return $this->eye;
    }

    public function getFill()
    {
        return $this->fill;
    }
}
