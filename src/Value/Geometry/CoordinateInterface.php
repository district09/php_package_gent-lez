<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use DigipolisGent\Value\ValueInterface;

/**
 * Interface to represent a geographical coordinate.
 */
interface CoordinateInterface extends ValueInterface
{
    /**
     * Get the x position.
     *
     * @return float
     */
    public function xPosition(): float;

    /**
     * Get the y position.
     *
     * @return float
     */
    public function yPosition(): float;
}
