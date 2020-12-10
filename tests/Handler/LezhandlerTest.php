<?php

declare(strict_types=1);

namespace Handler;

use District09\Gent\Lez\Handler\LezHandler;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Response\LezResponse;
use District09\Gent\Lez\Value\Features;
use GuzzleHttp\Psr7\Stream;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

/**
 * @covers \District09\Gent\Lez\Handler\LezHandler
 */
class LezhandlerTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Handles only LezRequests.
     *
     * @test
     */
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
     *
     * @test
     */
    public function itConvertsResponseDataIntoLezResponse(): void
    {
        $stream = $this->prophesize(Stream::class);
        $stream
            ->getContents()
            ->willReturn('{"resource":"LEZ","features":[]}');

        $response = $this->prophesize(ResponseInterface::class);
        $response
            ->getBody()
            ->willReturn($stream->reveal());

        $expected = new LezResponse(
            Features::fromResourceAndFeatures('LEZ', ...[])
        );

        $handler = new LezHandler();
        self::assertEquals(
            $expected,
            $handler->toResponse($response->reveal())
        );
    }
}
