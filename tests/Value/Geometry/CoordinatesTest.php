<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value\Geometry;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Value\Geometry\Coordinates.
 */
#[CoversClass(Coordinates::class)]
final class CoordinatesTest extends TestCase
{
    /**
     * Coordinates collection is created from one or more Lambert72 coordinates.
     */
    #[Test]
    public function itCanBeCreatedFromOneOrMoreLambert72Points(): void
    {
        $collection = Coordinates::fromLambert72(
            Lambert72::fromXYPosition(97000.01, 171000.02),
            Lambert72::fromXYPosition(98000.01, 172000.02),
        );

        $iterator = $collection->getIterator();
        self::assertCount(2, $iterator);
    }

    /**
     * Cast to string results in points separated by ";".
     */
    #[Test]
    public function itCanBeCastedToString(): void
    {
        $collection = Coordinates::fromLambert72(
            Lambert72::fromXYPosition(97000.01, 171000.02),
            Lambert72::fromXYPosition(98000.01, 172000.02),
        );

        self::assertSame(
            '97000.01 171000.02;98000.01 172000.02',
            (string) $collection
        );
    }
}
