<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Polygon geometrical figure.
 */
final class Polygon extends CollectionAbstract implements GeometryInterface
{

    /**
     * Named constructors only.
     *
     * @see \District09\Gent\Lez\Value\Geometry\Polygon::coordinates().
     */
    private function __construct()
    {
        // See Polygon::coordinates().
    }

    /**
     * Create polygon from one or more coordinates collections..
     *
     * @param \District09\Gent\Lez\Value\Geometry\Coordinates ...$coordinates
     *   The coordinates of the polygon.
     *
     * @return \District09\Gent\Lez\Value\Geometry\Polygon
     */
    public static function fromCoordinates(Coordinates ...$coordinates): Polygon
    {
        $polygon = new Polygon();
        $polygon->values = $coordinates;

        return $polygon;
    }

    /**
     * @inheritDoc
     *
     * This will return the string representation of the coordinates separated
     * by a newline character.
     */
    public function __toString(): string
    {
        $items = [];
        foreach ($this->values as $coordinates) {
            $items[] = (string) $coordinates;
        }

        return implode(PHP_EOL, $items);
    }
}
