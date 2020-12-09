<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value;

use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;
use District09\Gent\Lez\Value\Properties;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Value\Feature
 */
class FeatureTest extends TestCase
{
    /**
     * Feature is created from properties and geometry.
     *
     * @test
     */
    public function itIsCreatedFromItsDetails(): void
    {
        $properties = Properties::fromGentAndUriId('Foo', 'gent/foo');
        $geometry = Polygon::fromCoordinates(Coordinates::fromLambert72());

        $feature = Feature::fromPropertiesAndGeometry($properties, $geometry);

        self::assertSame($properties, $feature->properties());
        self::assertSame($geometry, $feature->geometry());
    }

    /**
     * Features are the same when they share the same properties & geometry.
     *
     * @param \District09\Gent\Lez\Value\Feature $otherFeature
     *   The other feature to compare.
     * @param bool $same
     *   Both features should be the same.
     *
     * @dataProvider otherFeatureProvider
     *
     * @test
     */
    public function itIsSamePropertiesWhenTheyShareSameValues(
        Feature $otherFeature,
        bool $same
    ): void {
        $feature = Feature::fromPropertiesAndGeometry(
            Properties::fromGentAndUriId('Foo', 'gent/foo'),
            Polygon::fromCoordinates(
                Coordinates::fromLambert72(
                    Lambert72::fromXYPosition(0, 0)
                )
            )
        );

        self::assertSame($same, $feature->sameValueAs($otherFeature));
    }

    /**
     * Other properties data provider.
     *
     * @retrun array
     *   Rows containing:
     *   - The other properties to compare against.
     *   - Should be the same.
     */
    public function otherFeatureProvider(): array
    {
        $sameProperties = Properties::fromGentAndUriId('Foo', 'gent/foo');
        $otherProperties = Properties::fromGentAndUriId('Fizz', 'gent/fizz');
        $sameGeometry = Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(0, 0)
            )
        );
        $otherGeometry = Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(100, 100)
            )
        );

        return [
            'Not the same when the properties are different' => [
                Feature::fromPropertiesAndGeometry(
                    $otherProperties,
                    $sameGeometry
                ),
                false,
            ],
            'Not the same when the geometry different' => [
                Feature::fromPropertiesAndGeometry(
                    $sameProperties,
                    $otherGeometry
                ),
                false,
            ],
            'Same when Properties and Geometry is the same value' => [
                Feature::fromPropertiesAndGeometry(
                    $sameProperties,
                    $sameGeometry
                ),
                true,
            ],
        ];
    }

    /**
     * The string value is the properties casted to string.
     *
     * @test
     */
    public function itCanBeCastedToString(): void
    {
        $feature = Feature::fromPropertiesAndGeometry(
            Properties::fromGentAndUriId('Foo', 'gent/foo'),
            Polygon::fromCoordinates(
                Coordinates::fromLambert72(
                    Lambert72::fromXYPosition(0, 0)
                )
            )
        );

        self::assertEquals('Foo (gent/foo)', (string) $feature);
    }
}
