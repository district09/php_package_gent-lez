<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value\Geometry;

use District09\Gent\Lez\Value\Geometry\Wgs84;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Value\Geometry\Wgs84
 */
class Wgs84Test extends TestCase
{
    /**
     * Point can be created from x and y position.
     *
     * @param float $latitude
     * @param float $longitude
     * @param bool $expectException
     *
     * @dataProvider coordinatesProvider
     *
     * @test
     */
    public function itCanBeCreatedFromXAndYPosition(
        float $latitude,
        float $longitude,
        bool $expectException
    ): void {
        if ($expectException) {
            $this->expectException(InvalidArgumentException::class);
        }

        // Latitude & longitude are in y, x order.
        $coordinate = Wgs84::fromLatitudeLongitude($latitude, $longitude);
        self::assertSame($longitude, $coordinate->xPosition());
        self::assertSame($latitude, $coordinate->yPosition());
    }

    /**
     * Data provider to test creating the coordinate value.
     *
     * @return array
     *   Rows containing:
     *   - float : x-position value.
     *   - float : y-position value.
     *   - bool : the given values should trigger an exception.
     */
    public function coordinatesProvider(): array
    {
        return [
            'Exception when Latitude is less than -90' => [
                -90.000001,
                0,
                true,
            ],
            'Exception when Latitude is greater than 90' => [
                90.000001,
                0,
                true,
            ],
            'Exception when Longitude is less than -180' => [
                0,
                -180.000001,
                true,
            ],
            'Exception when Longitude is greater than 180' => [
                0,
                180.000001,
                true,
            ],
            'Value is created when Latitude and Longitude are within the minimum boundaries' => [
                -90,
                -180,
                false,
            ],
            'Value is created when Latitude and Longitude are within the maximum boundaries' => [
                90,
                180,
                false,
            ],
        ];
    }

    /**
     * String has proper properties order.
     *
     * The order should be [latitude (y)] [longitude (x)].
     *
     * @test
     */
    public function itCastToStringAsLatitudeLongitudeSeparatedByComma(): void
    {
        $coordinate = Wgs84::fromLatitudeLongitude(12.201, 11.101);
        self::assertSame('12.201 11.101', (string) $coordinate);
    }
}
