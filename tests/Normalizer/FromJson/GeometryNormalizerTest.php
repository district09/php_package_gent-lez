<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\GeometryNormalizer;
use District09\Gent\Lez\Normalizer\UnsupportedGeometry;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;

/**
 * @covers \District09\Gent\Lez\Normalizer\FromJson\GeometryNormalizer
 */
class GeometryNormalizerTest extends NormalizerTestBase
{

    /**
     * AN exception is thrown when the given geometry is not supported.
     *
     * @test
     */
    public function itThrowsExceptionWhenGeometryTypeIsNotSupported(): void
    {
        $json = (object)['type' => 'foobar'];
        $normalizer = new GeometryNormalizer();

        $this->expectException(UnsupportedGeometry::class);
        $normalizer->normalize($json);
    }

    /**
     * Polygon geometry is extracted from given data.
     *
     * @test
     */
    public function itExtractsPolygonFromJsonData(): void
    {
        $json = $this->getDecodedFeatureCollection();

        $expected = Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(105204.34799999744, 195474.46200000122),
                Lambert72::fromXYPosition(105178.27799999714, 195475.5300000012),
                Lambert72::fromXYPosition(105204.34799999744, 195474.46200000122)
            ),
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0),
                Lambert72::fromXYPosition(100, 100),
                Lambert72::fromXYPosition(0, 0)
            )
        );

        $normalizer = new GeometryNormalizer();

        self::assertEquals(
            $expected,
            $normalizer->normalize($json->features[0]->geometry)
        );
    }
}
