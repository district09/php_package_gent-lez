<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value\Geometry;

use PHPUnit\Framework\Attributes\CoversClass;
use District09\Gent\Lez\Value\Geometry\AbstractCoordinate;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Value\Geometry\AbstractCoordinate and District09\Gent\Lez\Value\Geometry\Lambert72.
 */
#[CoversClass(AbstractCoordinate::class)]
#[CoversClass(Lambert72::class)]
final class Lambert72Test extends TestCase
{
    /**
     * Point can be created from x and y position.
     */
    #[Test]
    public function itCanBeCreatedFromXAndYPosition(): void
    {
        $coordinate = Lambert72::fromXYPosition(97000.00, 171000.00);

        self::assertSame(97000.00, $coordinate->xPosition());
        self::assertSame(171000.00, $coordinate->yPosition());
    }

    /**
     * Values are the same if they share the same parameters.
     *
     * @param \District09\Gent\Lez\Value\Geometry\Lambert72 $value
     *   The value to compare another object with.
     * @param \District09\Gent\Lez\Value\Geometry\Lambert72 $otherValue
     *   The other object to compare.
     * @param bool $shouldBeTheSame
     *   Should both objects be identified as the same.
     *
     *
     */
    #[DataProvider('sameValueProvider')]
    #[Test]
    public function itIsTheSameValueWhenTheyShareXAndY(
        Lambert72 $value,
        Lambert72 $otherValue,
        bool $shouldBeTheSame
    ): void {
        self::assertEquals(
            $shouldBeTheSame,
            $value->sameValueAs($otherValue)
        );
    }

    /**
     * Data provider to test the same value method.
     *
     * @return array
     *   Each record in the array contains:
     *   - Lambert72Point : The value to compare against.
     *   - Lambert72Point : The value to compare with.
     *   - bool : Should both values be seen as the same.
     */
    public static function sameValueProvider(): array
    {
        return [
            'Not the same if x values are different' => [
                Lambert72::fromXYPosition(12.3, 45.6),
                Lambert72::fromXYPosition(21.3, 45.6),
                false,
            ],
            'Not the same if y values are different' => [
                Lambert72::fromXYPosition(12.3, 45.6),
                Lambert72::fromXYPosition(12.3, 54.6),
                false,
            ],
            'The same if x and y values are the same' => [
                Lambert72::fromXYPosition(12.3, 45.6),
                Lambert72::fromXYPosition(12.3, 45.6),
                true,
            ],
        ];
    }

    /**
     * Cast to string results in x,y.
     */
    #[Test]
    public function itCastToStringAsXYSeparatedByComma(): void
    {
        $coordinate = Lambert72::fromXYPosition(10.99, 20.01);
        self::assertSame('10.99 20.01', (string) $coordinate);
    }
}
