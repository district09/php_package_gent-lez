<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Client;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use District09\Gent\Lez\Client\Client;
use District09\Gent\Lez\Configuration\ConfigurationInterface;
use GuzzleHttp\Client as GuzzleClient;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface as PsrResponse;

/**
 * Tests District09\Gent\Lez\Client\Client.
 */
#[CoversClass(Client::class)]
final class ClientTest extends TestCase
{
    use ProphecyTrait;

    /**
     * No API user key is added to the header if no value within configuration.
     */
    #[Test]
    public function noApiUserKeyAddedIfNoValueInConfiguration(): void
    {
        $configuration = $this->prophesize(ConfigurationInterface::class);
        $configuration->apiKey()->willReturn('');

        $finalRequestMock = $this->prophesize(RequestInterface::class);
        $finalRequestMock
            ->withHeader('apiKey', Argument::any())
            ->shouldNotBeCalled();
        $finalRequest = $finalRequestMock->reveal();

        $initialRequestMock = $this->prophesize(RequestInterface::class);
        $initialRequestMock
            ->getBody()
            ->willReturn('123');
        $initialRequestMock
            ->withHeader(Argument::any(), Argument::any())
            ->willReturn($finalRequest);
        $initialRequest = $initialRequestMock->reveal();

        $guzzleResponse = $this->prophesize(PsrResponse::class)->reveal();

        $response = $this->prophesize(ResponseInterface::class)->reveal();

        $guzzleClient = $this->prophesize(GuzzleClient::class);
        $guzzleClient
            ->send($finalRequest)
            ->willReturn($guzzleResponse);

        $handler = $this->prophesize(HandlerInterface::class);
        $handler->handles()->willReturn([get_class($initialRequest)]);
        $handler->toResponse($guzzleResponse)->willReturn($response);

        $client = new Client($guzzleClient->reveal(), $configuration->reveal());
        $client->addHandler($handler->reveal());
        $client->send($initialRequest);
    }

    /**
     * API Key is send as header.
     */
    #[Test]
    public function apiUserKeyIsSendAsHeader(): void
    {
        $configuration = $this->prophesize(ConfigurationInterface::class);
        $configuration->apiKey()->willReturn('fiz-baz-key');

        $finalRequest = $this->prophesize(RequestInterface::class)->reveal();

        $requestWithUserKey = $this->prophesize(RequestInterface::class);
        $requestWithUserKey
            ->withHeader('apiKey', 'fiz-baz-key')
            ->willReturn($finalRequest)
            ->shouldBeCalled();

        $initialRequestMock = $this->prophesize(RequestInterface::class);
        $initialRequestMock
            ->getBody()
            ->willReturn('123');
        $initialRequestMock
            ->withHeader(Argument::any(), Argument::any())
            ->willReturn($requestWithUserKey->reveal());
        $initialRequest = $initialRequestMock->reveal();

        $guzzleResponse = $this->prophesize(PsrResponse::class)->reveal();

        $response = $this->prophesize(ResponseInterface::class)->reveal();

        $guzzleClient = $this->prophesize(GuzzleClient::class);
        $guzzleClient
            ->send($finalRequest)
            ->willReturn($guzzleResponse);

        $handler = $this->prophesize(HandlerInterface::class);
        $handler->handles()->willReturn([get_class($initialRequest)]);
        $handler->toResponse($guzzleResponse)->willReturn($response);

        $client = new Client($guzzleClient->reveal(), $configuration->reveal());
        $client->addHandler($handler->reveal());
        $client->send($initialRequest);
    }
}
