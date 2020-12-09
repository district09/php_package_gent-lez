<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\FeatureNormalizer;
use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;
use District09\Gent\Lez\Value\Properties;

/**
 * @covers \District09\Gent\Lez\Normalizer\FromJson\FeatureNormalizer
 */
class FeatureNormalizerTest extends NormalizerTestBase
{

    /**
     * Feature is extracted from given data.
     *
     * @test
     */
    public function itExtractsFeatureFromJsonData(): void
    {
        $json = $this->getDecodedFeatureCollection();

        $expected = Feature::fromPropertiesAndGeometry(
            Properties::fromGentAndUriId('LEZ1', 'milieuqa/lez13'),
            Polygon::fromCoordinates(
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
            )
        );

        $normalizer = new FeatureNormalizer();

        self::assertEquals(
            $expected,
            $normalizer->normalize($json->features[0])
        );
    }
}
