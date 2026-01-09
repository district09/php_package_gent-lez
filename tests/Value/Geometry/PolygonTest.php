<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value\Geometry;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Value\Geometry\Polygon.
 */
#[CoversClass(Polygon::class)]
final class PolygonTest extends TestCase
{
    /**
     * Polygon is created from its coordinates.
     */
    #[Test]
    public function itIsCreatedFromCoordinates(): void
    {
        $polygon = Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0),
                Lambert72::fromXYPosition(100, 100),
                Lambert72::fromXYPosition(0, 0),
            ),
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0),
            ),
        );

        self::assertCount(2, $polygon->getIterator());
    }

    /**
     * The coordinates are used to get the string representation.
     */
    #[Test]
    public function itUsesCoordinatesStringsAsString(): void
    {
        $polygon = Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0),
                Lambert72::fromXYPosition(100, 100),
                Lambert72::fromXYPosition(0, 0),
            ),
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0),
            ),
        );

        self::assertSame(
            '0 0;100 100;0 0' . PHP_EOL . '0 0',
            (string) $polygon
        );
    }
}
