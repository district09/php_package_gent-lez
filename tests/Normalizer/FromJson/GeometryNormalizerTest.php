<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\GeometryNormalizer;
use District09\Gent\Lez\Normalizer\UnsupportedGeometry;
use District09\Tests\Gent\Lez\fixtures\WithFeatureCollectionTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\GeometryNormalizer.
 */
#[CoversClass(GeometryNormalizer::class)]
final class GeometryNormalizerTest extends TestCase
{
    use WithFeatureCollectionTrait;

    /**
     * AN exception is thrown when the given geometry is not supported.
     */
    #[Test]
    public function itThrowsExceptionWhenGeometryTypeIsNotSupported(): void
    {
        $json = 'POINT (105480.21567926178 192222.4694100318)';
        $normalizer = new GeometryNormalizer();

        $this->expectException(UnsupportedGeometry::class);
        $normalizer->normalize($json);
    }

    /**
     * Polygon geometry is extracted from given data.
     */
    #[Test]
    public function itExtractsPolygonFromJsonData(): void
    {
        $json = $this->getDecodedJson();

        $normalizer = new GeometryNormalizer();
        self::assertEquals(
            $this->getFeatureCollection()->features()[0]->geometry(),
            $normalizer->normalize($json[0]->items[0]->Shape)
        );
    }
}
