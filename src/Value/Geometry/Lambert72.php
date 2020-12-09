<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

/**
 * Lambert 72 representation of a geographical coordinate.
 */
final class Lambert72 extends AbstractCoordinate
{

    /**
     * Create new Lambert 72 coordinate from its x and y position.
     *
     * @param float $xPosition
     * @param float $yPosition
     *
     * @return \District09\Gent\Lez\Value\Geometry\Lambert72
     *   The created Lambert72Point coordinate.
     */
    public static function fromXYPosition(float $xPosition, float $yPosition): Lambert72
    {
        return new self($xPosition, $yPosition);
    }
}
