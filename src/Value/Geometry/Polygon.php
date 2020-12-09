<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Polygon geometrical figure.
 */
final class Polygon extends ValueAbstract implements GeometryInterface
{

    /**
     * The coordinates.
     *
     * @var \District09\Gent\Lez\Value\Geometry\Coordinates
     */
    private $coordinates;

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
     * Create polygon from its coordinates.
     *
     * @param \District09\Gent\Lez\Value\Geometry\Coordinates $coordinates
     *   The coordinates of the polygon.
     *
     * @return \District09\Gent\Lez\Value\Geometry\Polygon
     */
    public static function fromCoordinates(Coordinates $coordinates): Polygon
    {
        $polygon = new Polygon();
        $polygon->coordinates = $coordinates;

        return $polygon;
    }

    public function coordinates(): Coordinates
    {
        return $this->coordinates;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \District09\Gent\Lez\Value\Geometry\Polygon $otherPolygon */
        $otherPolygon = $object;

        return $this->sameValueTypeAs($otherPolygon)
            && $this->coordinates()->sameValueAs($otherPolygon->coordinates());
    }

    /**
     * @inheritDoc
     *
     * This will return the string representation of the coordinates.
     */
    public function __toString(): string
    {
        return (string) $this->coordinates();
    }
}
