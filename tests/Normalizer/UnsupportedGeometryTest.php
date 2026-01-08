<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Normalizer\UnsupportedGeometry;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\UnsupportedGeometry.
 */
#[CoversClass(UnsupportedGeometry::class)]
final class UnsupportedGeometryTest extends TestCase
{
    /**
     * Exception can be created from the unsupported type.
     */
    #[Test]
    public function itIsCreatedByUnsupportedType(): void
    {
        $exception = UnsupportedGeometry::type('FooBar');

        self::assertEquals(
            'Geometry type FooBar is not supported.',
            $exception->getMessage()
        );
        self::assertSame(400, $exception->getCode());
    }
}
