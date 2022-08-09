<?php

namespace BaconQrCode\Renderer\Path;

use IteratorAggregate;
use Traversable;

/**
 * Internal Representation of a vector path.
 */
final class Path implements IteratorAggregate
{
    /**
     * @var OperationInterface[]
     */
    private $operations = [];

    /**
     * Moves the drawing operation to a certain position.
     */
    public function move($x, $y)
    {
        $path = clone $this;
        $path->operations[] = new Move($x, $y);
        return $path;
    }

    /**
     * Draws a line from the current position to another position.
     */
    public function line($x, $y)
    {
        $path = clone $this;
        $path->operations[] = new Line($x, $y);
        return $path;
    }

    /**
     * Draws an elliptic arc from the current position to another position.
     */
    public function ellipticArc(
        $xRadius,
        $yRadius,
        $xAxisRotation,
        $largeArc,
        $sweep,
        $x,
        $y
    ) {
        $path = clone $this;
        $path->operations[] = new EllipticArc($xRadius, $yRadius, $xAxisRotation, $largeArc, $sweep, $x, $y);
        return $path;
    }

    /**
     * Draws a curve from the current position to another position.
     */
    public function curve($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $path = clone $this;
        $path->operations[] = new Curve($x1, $y1, $x2, $y2, $x3, $y3);
        return $path;
    }

    /**
     * Closes a sub-path.
     */
    public function close()
    {
        $path = clone $this;
        $path->operations[] = Close::instance();
        return $path;
    }

    /**
     * Appends another path to this one.
     */
    public function append(self $other)
    {
        $path = clone $this;
        $path->operations = array_merge($this->operations, $other->operations);
        return $path;
    }

    public function translate($x, $y)
    {
        $path = new self();

        foreach ($this->operations as $operation) {
            $path->operations[] = $operation->translate($x, $y);
        }

        return $path;
    }

    /**
     * @return OperationInterface[]|Traversable
     */
    public function getIterator()
    {
        foreach ($this->operations as $operation) {
            yield $operation;
        }
    }
}
