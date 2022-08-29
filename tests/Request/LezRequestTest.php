<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Request;

use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Request\LezRequest
 */
class LezRequestTest extends TestCase
{
    /**
     * The URI is set based on the given coordinates.
     *
     * @test
     */
    public function itCreatesUriBasedOnCoordinates(): void
    {
        $coordinates = Lambert72::fromXYPosition(100, 1000);

        $request = new LezRequest($coordinates);

        self::assertEquals(
            'pbuffer?wkid=31370&pointx=100&pointy=1000&bufferdistance=1',
            $request->getRequestTarget()
        );
    }
}
