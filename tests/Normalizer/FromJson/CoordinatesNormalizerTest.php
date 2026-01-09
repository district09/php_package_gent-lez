<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\CoordinatesNormalizer;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\CoordinatesNormalizer.
 */
#[CoversClass(CoordinatesNormalizer::class)]
final class CoordinatesNormalizerTest extends TestCase
{
    /**
     * Coordinates are extracted from given data.
     */
    #[Test]
    public function itExtractsCoordinatesFromJsonData(): void
    {
        $expected = Coordinates::fromLambert72(
            Lambert72::fromXYPosition(105204.34799999744, 195474.46200000122),
            Lambert72::fromXYPosition(105178.27799999714, 195475.5300000012),
            Lambert72::fromXYPosition(105204.34799999744, 195474.46200000122)
        );

        $normalizer = new CoordinatesNormalizer();
        self::assertEquals(
            $expected,
            $normalizer->normalize([
                [105204.34799999744, 195474.46200000122],
                [105178.27799999714, 195475.5300000012],
                [105204.34799999744, 195474.46200000122],
            ])
        );
    }
}
