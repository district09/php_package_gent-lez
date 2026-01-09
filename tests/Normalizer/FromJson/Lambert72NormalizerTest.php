<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\Lambert72Normalizer;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\Lambert72Normalizer.
 */
#[CoversClass(Lambert72Normalizer::class)]
final class Lambert72NormalizerTest extends TestCase
{
    /**
     * Lambert72 coordinate is extracted from given data.
     */
    #[Test]
    public function itExtractsLambert72FromJsonData(): void
    {
        $normalizer = new Lambert72Normalizer();
        self::assertEquals(
            Lambert72::fromXYPosition(105204.34799999744, 195474.46200000122),
            $normalizer->normalize([105204.34799999744, 195474.46200000122])
        );
    }
}
