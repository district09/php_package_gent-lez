<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Normalizer\FromJson\Lambert72Normalizer;
use District09\Gent\Lez\Value\Geometry\Lambert72;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\Lambert72Normalizer.
 */
#[CoversClass(Lambert72Normalizer::class)]
final class Lambert72NormalizerTest extends NormalizerTestBase
{
    /**
     * Lambert72 coordinate is extracted from given data.
     */
    #[Test]
    public function itExtractsLambert72FromJsonData(): void
    {
        $json = $this->getDecodedFeatureCollection();

        $normalizer = new Lambert72Normalizer();
        self::assertEquals(
            Lambert72::fromXYPosition(105204.34799999744, 195474.46200000122),
            $normalizer->normalize($json->features[0]->geometry->coordinates[0][0])
        );
    }
}
