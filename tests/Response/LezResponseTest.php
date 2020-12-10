<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Response;

use District09\Gent\Lez\Response\LezResponse;
use District09\Gent\Lez\Value\FeaturesInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \District09\Gent\Lez\Response\LezResponse
 */
class LezResponseTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Response can be created from Features collection.
     *
     * @test
     */
    public function itCanBeCreatedFromFeaturesCollection(): void
    {
        $features = $this->prophesize(FeaturesInterface::class)->reveal();

        $response = new LezResponse($features);
        self::assertSame($features, $response->features());
    }
}
