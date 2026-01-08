<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Response;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Response\LezResponse;
use District09\Gent\Lez\Value\FeaturesInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Tests District09\Gent\Lez\Response\LezResponse.
 */
#[CoversClass(LezResponse::class)]
final class LezResponseTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Response can be created from Features collection.
     */
    #[Test]
    public function itCanBeCreatedFromFeaturesCollection(): void
    {
        $features = $this->prophesize(FeaturesInterface::class)->reveal();

        $response = new LezResponse($features);
        self::assertSame($features, $response->features());
    }
}
