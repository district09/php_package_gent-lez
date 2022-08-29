<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\UnsupportedGeometry;
use District09\Gent\Lez\Value\Geometry\Polygon;

/**
 * Extracts a Geometry object out of json decoded data.
 */
final class GeometryNormalizer
{
    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \District09\Gent\Lez\Value\Geometry\Polygon
     *
     * @throws \District09\Gent\Lez\Normalizer\UnsupportedGeometry
     *   When the json data contains a geometry type that is not supported.
     */
    public function normalize(object $jsonData): Polygon
    {
        $type = strtolower($jsonData->type);
        if ($type !== 'polygon') {
            throw UnsupportedGeometry::type($type);
        }

        return Polygon::fromCoordinates(
            ...$this->normalizeCoordinates($jsonData)
        );
    }

    /**
     * Normalize the coordinates.
     *
     * @param object $jsonData
     *
     * @return \District09\Gent\Lez\Value\Geometry\Coordinates[]
     */
    private function normalizeCoordinates(object $jsonData): array
    {
        $normalizer = new CoordinatesNormalizer();

        $coordinates = [];
        foreach ($jsonData->coordinates as $data) {
            $coordinates[] = $normalizer->normalize($data);
        }

        return $coordinates;
    }
}
