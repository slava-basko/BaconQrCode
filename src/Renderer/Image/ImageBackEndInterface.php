<?php

namespace BaconQrCode\Renderer\Image;

use BaconQrCode\Exception\RuntimeException;
use BaconQrCode\Renderer\Color\ColorInterface;
use BaconQrCode\Renderer\Path\Path;
use BaconQrCode\Renderer\RendererStyle\Gradient;

/**
 * Interface for back ends able to produce path based images.
 */
interface ImageBackEndInterface
{
    /**
     * Starts a new image.
     *
     * If a previous image was already started, previous data get erased.
     */
    public function create($size, ColorInterface $backgroundColor);

    /**
     * Transforms all following drawing operation coordinates by scaling them by a given factor.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function scale($size);

    /**
     * Transforms all following drawing operation coordinates by translating them by a given amount.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function translate($x, $y);

    /**
     * Transforms all following drawing operation coordinates by rotating them by a given amount.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function rotate($degrees);

    /**
     * Pushes the current coordinate transformation onto a stack.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function push();

    /**
     * Pops the last coordinate transformation from a stack.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function pop();

    /**
     * Draws a path with a given color.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function drawPathWithColor(Path $path, ColorInterface $color);

    /**
     * Draws a path with a given gradient which spans the box described by the position and size.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function drawPathWithGradient(
        Path $path,
        Gradient $gradient,
        $x,
        $y,
        $width,
        $height
    );

    /**
     * Ends the image drawing operation and returns the resulting blob.
     *
     * This should reset the state of the back end and thus this method should only be callable once per image.
     *
     * @throws RuntimeException if no image was started yet.
     */
    public function done();
}
