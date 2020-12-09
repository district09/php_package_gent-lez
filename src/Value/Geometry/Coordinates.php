<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use DigipolisGent\Value\CollectionAbstract;

/**
 * Collection of Lambert72 coordinates.
 */
final class Coordinates extends CollectionAbstract
{

    /**
     * Named constructors only.
     *
     * @see Coordinates::fromLambert72()
     */
    private function __construct()
    {
        // Coordinates::fromLambert72().
    }

    /**
     * Create collection from one or more Lambert 72 coordinates.
     *
     * @param \District09\Gent\Lez\Value\Geometry\Lambert72 ...$coordinates
     *   The coordinates.
     *
     * @return \District09\Gent\Lez\Value\Geometry\Coordinates
     *   The coordinates collection.
     */
    public static function fromLambert72(Lambert72 ...$coordinates): Coordinates
    {
        $collection = new Coordinates();
        $collection->values = $coordinates;

        return $collection;
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        $coordinates = [];
        foreach ($this->values as $value) {
            $coordinates[] = (string) $value;
        }

        return implode(';', $coordinates);
    }
}
