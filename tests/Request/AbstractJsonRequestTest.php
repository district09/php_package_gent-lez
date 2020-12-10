<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Request;

use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Request\AbstractJsonRequest
 */
class AbstractJsonRequestTest extends TestCase
{
    /**
     * The method and accept header are set.
     *
     * @test
     */
    public function itSetsMethodAndAcceptHeader(): void
    {
        $coordinates = Lambert72::fromXYPosition(100, 1000);

        $request = new LezRequest($coordinates);

        self::assertEquals(MethodType::GET, $request->getMethod());
        self::assertEquals([AcceptType::JSON], $request->getHeader('Accept'));
    }
}
