<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\Features;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Polygon;
use District09\Gent\Lez\Value\Properties;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Value\Features.
 */
#[CoversClass(Features::class)]
final class FeaturesTest extends TestCase
{
    /**
     * Features is created from resource and one or more feature items.
     */
    #[Test]
    public function itIsCreatedFromResourceAndFeatureItems(): void
    {
        $featureItems = self::createFeatureItems();

        $features = Features::fromResourceAndFeatures(
            'FooBar',
            ...$featureItems
        );

        self::assertSame('FooBar', $features->resource());
        self::assertTrue($features->hasFeatures());
        self::assertSame($featureItems, $features->features());
    }

    /**
     * Feature collections are same when they share same resource and items.
     *
     * @param \District09\Gent\Lez\Value\Features $otherFeatures
     *   The other features to compare.
     * @param bool $same
     *   Both features should be the same.
     *
     *
     */
    #[DataProvider('otherFeaturesProvider')]
    #[Test]
    public function itIsSamePropertiesWhenTheyShareSameValues(
        Features $otherFeatures,
        bool $same
    ): void {
        $features = Features::fromResourceAndFeatures(
            'FooBar',
            ...self::createFeatureItems()
        );

        self::assertSame($same, $features->sameValueAs($otherFeatures));
    }

    /**
     * Other properties data provider.
     *
     * @retrun array
     *   Rows containing:
     *   - The other properties to compare against.
     *   - Should be the same.
     */
    public static function otherFeaturesProvider(): array
    {
        return [
            'Not the same when the resources are different' => [
                Features::fromResourceAndFeatures(
                    'FizzBuzz',
                    ...self::createFeatureItems()
                ),
                false,
            ],
            'Not the same when the feature items are different' => [
                Features::fromResourceAndFeatures(
                    'FooBar',
                    ...[]
                ),
                false,
            ],
            'Same when Properties and Geometry is the same value' => [
                Features::fromResourceAndFeatures(
                    'FooBar',
                    ...self::createFeatureItems()
                ),
                true,
            ],
        ];
    }

    /**
     * The string value contains only the resource identifier.
     */
    #[Test]
    public function itCanBeCastedToString(): void
    {
        $features = Features::fromResourceAndFeatures(
            'FooBar',
            ...$this->createFeatureItems()
        );

        self::assertEquals('FooBar', (string) $features);
    }

    /**
     * Create an array of feature items.
     *
     * @return \District09\Gent\Lez\Value\Feature[]
     */
    private static function createFeatureItems(): array
    {
        return [
            Feature::fromPropertiesAndGeometry(
                Properties::fromGentAndUriId('foo', 'gent/foo'),
                Polygon::fromCoordinates(
                    Coordinates::fromLambert72()
                )
            ),
            Feature::fromPropertiesAndGeometry(
                Properties::fromGentAndUriId('fizz', 'gent/fizz'),
                Polygon::fromCoordinates(
                    Coordinates::fromLambert72()
                )
            )
        ];
    }
}
