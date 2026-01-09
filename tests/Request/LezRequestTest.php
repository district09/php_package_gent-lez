<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Request;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Request\LezRequest.
 */
#[CoversClass(LezRequest::class)]
final class LezRequestTest extends TestCase
{
    /**
     * The URI is set based on the given coordinates.
     */
    #[Test]
    public function itCreatesUriBasedOnCoordinates(): void
    {
        $coordinates = Lambert72::fromXYPosition(100, 1000);

        $request = new LezRequest($coordinates);

        self::assertEquals(
            'pointbuffer?wkid=31370&pointx=100&pointy=1000&bufferdistance=1',
            $request->getRequestTarget()
        );
    }
}
