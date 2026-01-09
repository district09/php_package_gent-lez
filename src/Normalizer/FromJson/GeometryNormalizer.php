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
     * @param string $shape
     *   The shape data to normalize
     *
     * @return \District09\Gent\Lez\Value\Geometry\Polygon
     *
     * @throws \District09\Gent\Lez\Normalizer\UnsupportedGeometry
     *   When the json data contains a geometry type that is not supported.
     */
    public function normalize(string $shape): Polygon
    {
        $this->assertWktIsPolygon($shape);

        return Polygon::fromCoordinates(
            ...$this->normalizeCoordinates($this->extractPolygonCoordinates($shape))
        );
    }

    /**
     * Normalize the coordinates.
     *
     * @param array<int, array<int, float>> $items
     *
     * @return \District09\Gent\Lez\Value\Geometry\Coordinates[]
     */
    private function normalizeCoordinates(array $items): array
    {
        $normalizer = new CoordinatesNormalizer();

        $coordinates = [];
        foreach ($items as $item) {
            $coordinates[] = $normalizer->normalize($item);
        }

        return $coordinates;
    }

    /**
     * Check if WKT is a polygon.
     *
     * @throws \District09\Gent\Lez\Normalizer\UnsupportedGeometry
     *    When WKT is not a POLYGON.
     */
    private function assertWktIsPolygon(string $wkt): void
    {
        $type = null;

        $wkt = trim($wkt);
        if (preg_match('/^([A-Z]+)\s*\(/i', $wkt, $matches)) {
            $type = strtoupper($matches[1]);
        }

        if ($type === 'POLYGON') {
            return;
        }

        throw UnsupportedGeometry::type($type);
    }

    /**
     * Extract coordinates from a WKT POLYGON string.
     *
     * @param string $wkt
     *   The WKT string.
     *
     * @return list<list<array<int, float>>>
     *   The coordinates.
     */
    private function extractPolygonCoordinates(string $wkt): array
    {
        $wkt = trim($wkt);
        preg_match('/^POLYGON\s*\(\((.+)\)\)$/i', $wkt, $matches);

        // Split rings (handles holes).
        $rings = preg_split('/\)\s*,\s*\(/', $matches[1]);

        $result = [];
        foreach ($rings as $ring) {
            $points = explode(',', $ring);
            $coordinates = [];

            foreach ($points as $point) {
                $point = trim($point);
                [$pointX, $pointY] = preg_split('/\s+/', $point);
                $coordinates[] = [(float) $pointX, (float) $pointY];
            }

            $result[] = $coordinates;
        }

        return $result;
    }
}
