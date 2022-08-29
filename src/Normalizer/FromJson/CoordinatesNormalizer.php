<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Value\Geometry\Coordinates;

/**
 * Extracts a Coordinates collection out of json decoded array of coordinates.
 */
final class CoordinatesNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param array $jsonData
     *
     * @return \District09\Gent\Lez\Value\Geometry\Coordinates
     */
    public function normalize(array $jsonData): Coordinates
    {
        $normalizer = new Lambert72Normalizer();

        $items = [];
        foreach ($jsonData as $itemData) {
            $items[] = $normalizer->normalize($itemData);
        }

        return Coordinates::fromLambert72(...$items);
    }
}
