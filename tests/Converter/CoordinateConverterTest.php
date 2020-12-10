<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Converter;

use District09\Gent\Lez\Converter\CoordinateConverter;
use District09\Gent\Lez\Value\Geometry\CoordinateInterface;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Wgs84;
use PHPStan\Testing\TestCase;

/**
 * @covers \District09\Gent\Lez\Converter\CoordinateConverter
 */
class CoordinateConverterTest extends TestCase
{

    /**
     * Coordinates can be converted to Lambert72.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *   The coordinate to convert.
     * @param \District09\Gent\Lez\Value\Geometry\Lambert72 $expected
     *   The expected transformed coordinate.
     *
     * @dataProvider toLambert72Provider
     *
     * @test
     */
    public function itConvertsToLambert72(
        CoordinateInterface $coordinate,
        Lambert72 $expected
    ): void {
        $converter = new CoordinateConverter();

        self::assertEquals(
            $expected,
            $converter->toLambert72($coordinate)
        );
    }

    /**
     * Data provider to test the to Lambert72 conversion.
     *
     * @return array
     *   Rows containing:
     *   - The coordinate to convert.
     *   - The expected converted coordinate.
     */
    public function toLambert72Provider(): array
    {
        $wgs84 = Wgs84::fromLatitudeLongitude(51.03758127798061, 3.735658261502679);
        $lambert72 = Lambert72::fromXYPosition(105595.27868181054, 192122.78018975444);

        return [
            'No conversion when point is already Lambert72' => [
                $lambert72,
                $lambert72
            ],
            'Conversion from Wgs84 to Lambert72' => [
                $wgs84,
                $lambert72
            ],
        ];
    }

    /**
     * Coordinates can be converted to Wgs84.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *   The coordinate to convert.
     * @param \District09\Gent\Lez\Value\Geometry\Wgs84 $expected
     *   The expected transformed coordinate.
     *
     * @dataProvider toWgs84Provider
     *
     * @test
     */
    public function itConvertsToWgs84(
        CoordinateInterface $coordinate,
        Wgs84 $expected
    ): void {
        $converter = new CoordinateConverter();

        self::assertEquals(
            $expected,
            $converter->toWgs84($coordinate)
        );
    }

    /**
     * Data provider to test the to Wgs84 conversion.
     *
     * Note: there is a slight difference depending on the transformation
     * direction.
     *
     * @return array
     *   Rows containing:
     *   - The coordinate to convert.
     *   - The expected converted coordinate.
     */
    public function toWgs84Provider(): array
    {
        $wgs84 = Wgs84::fromLatitudeLongitude(51.03758127958531, 3.735658242686581);
        $lambert72 = Lambert72::fromXYPosition(105595.27868181054, 192122.78018975444);

        return [
            'No conversion when point is already Wgs84' => [
                $wgs84,
                $wgs84
            ],
            'Conversion from Lambert72 to Wgs84' => [
                $lambert72,
                $wgs84
            ],
        ];
    }
}
