<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer;

use District09\Gent\Lez\Normalizer\UnsupportedGeometry;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Normalizer\UnsupportedGeometry
 */
class UnsupportedGeometryTest extends TestCase
{
    /**
     * Exception can be created from the unsupported type.
     *
     * @test
     */
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
