<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Handler;

use District09\Tests\Gent\Lez\fixtures\WithFeatureCollectionTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Handler\LezHandler;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Response\LezResponse;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * Tests District09\Gent\Lez\Handler\LezHandler.
 */
#[CoversClass(LezHandler::class)]
final class LezhandlerTest extends TestCase
{
    use ProphecyTrait;
    use WithFeatureCollectionTrait;

    /**
     * Handles only LezRequests.
     */
    #[Test]
    public function itHandlesOnlyLezRequests(): void
    {
        $handler = new LezHandler();

        self::assertEquals(
            [LezRequest::class],
            $handler->handles()
        );
    }

    /**
     * The response data is converted into a LezResponse.
     */
    #[Test]
    public function itConvertsResponseDataIntoLezResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream
            ->getContents()
            ->willReturn($this->getRawJson());

        $response = $this->prophesize(ResponseInterface::class);
        $response
            ->getBody()
            ->willReturn($stream->reveal());

        $expected = new LezResponse($this->getFeatureCollection());

        $handler = new LezHandler();
        self::assertEquals(
            $expected,
            $handler->toResponse($response->reveal())
        );
    }
}
