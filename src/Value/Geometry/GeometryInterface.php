<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use DigipolisGent\Value\ValueInterface;

/**
 * A geometrical object.
 */
interface GeometryInterface extends ValueInterface
{

    /**
     * Get the coordinates.
     *
     * @return \District09\Gent\Lez\Value\Geometry\Coordinates
     */
    public function coordinates(): Coordinates;
}
