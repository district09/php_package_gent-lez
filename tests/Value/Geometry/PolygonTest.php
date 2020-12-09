<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value\Geometry;

use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Value\Geometry\Polygon
 */
class PolygonTest extends TestCase
{
    /**
     * Polygon is created from its coordinates.
     *
     * @test
     */
    public function itIsCreatedFromCoordinates(): void
    {
        $coordinates = Coordinates::fromLambert72(
            Lambert72::fromXYPosition(0, 0),
            Lambert72::fromXYPosition(100, 100),
            Lambert72::fromXYPosition(0, 0)
        );

        $polygon = Polygon::fromCoordinates($coordinates);

        self::assertSame($coordinates, $polygon->coordinates());
    }

    /**
     * Same value if both polygons share the same coordinates.
     *
     * @param \District09\Gent\Lez\Value\Geometry\Coordinates $coordinates
     *   Coordinates of the polygon to compare.
     * @param \District09\Gent\Lez\Value\Geometry\Coordinates $otherCoordinates
     *   Coordinates ot the polygon to compare to.
     * @param bool $same
     *   Should both polygons be the same.
     *
     * @dataProvider coordinatesProvider
     *
     * @test
     */
    public function itIsSamePolygonWhenTheyShareSameCoordinates(
        Coordinates $coordinates,
        Coordinates $otherCoordinates,
        bool $same
    ): void {
        $polygon = Polygon::fromCoordinates($coordinates);
        $otherPolygon = Polygon::fromCoordinates($otherCoordinates);

        self::assertSame($same, $polygon->sameValueAs($otherPolygon));
    }

    /**
     * Coordinates data provider.
     *
     * @return array
     *   Rows containing:
     *   - Coordinates of the polygon to compare.
     *   - Coordinates ot the polygon to compare to.
     *   - Should both polygons be the same?
     */
    public function coordinatesProvider(): array
    {
        $coordinates = Coordinates::fromLambert72(
            Lambert72::fromXYPosition(0, 0),
            Lambert72::fromXYPosition(100, 100),
            Lambert72::fromXYPosition(0, 0),
        );
        $otherCoordinates = Coordinates::fromLambert72(
            Lambert72::fromXYPosition(100, 100),
            Lambert72::fromXYPosition(0, 0),
            Lambert72::fromXYPosition(100, 100),
        );

        return [
            'Not the same when the coordinates are different' => [
                $coordinates,
                $otherCoordinates,
                false,
            ],
            'Same when polygons share same coordinates' => [
                $coordinates,
                $coordinates,
                true,
            ],
        ];
    }

    /**
     * The coordinates are used to get the string representation.
     *
     * @test
     */
    public function itUsesCoordinatesStringAsString(): void
    {
        $polygon = Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0),
                Lambert72::fromXYPosition(100, 100),
                Lambert72::fromXYPosition(0, 0),
            )
        );

        self::assertSame(
            '0 0;100 100;0 0',
            (string) $polygon
        );
    }
}
