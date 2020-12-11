<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Client;

use DigipolisGent\API\Client\AbstractClient;
use DigipolisGent\API\Client\Response\ResponseInterface;
use DigipolisGent\API\Logger\RequestLog;
use Psr\Http\Message\RequestInterface;

/**
 * Client to communicate with the LEZ webservice endpoint.
 */
final class Client extends AbstractClient
{
    /**
     * @inheritDoc
     *
     * We do want the exceptions thrown by Guzzle to bubble up.
     */
    public function send(RequestInterface $request): ResponseInterface
    {
        $psrRequest = $this->injectHeaders($request);

        $this->log(new RequestLog($request));

        $handler = $this->getHandler($request);
        $psrResponse = $this->guzzle->send($psrRequest);

        return $handler->toResponse($psrResponse);
    }

    /**
     * @inheritdoc
     *
     * This will add the user key if a value is set.
     */
    protected function injectHeaders(RequestInterface $request): RequestInterface
    {
        $request = parent::injectHeaders($request);

        /** @var \District09\Gent\Lez\Configuration\ConfigurationInterface $configuration */
        $configuration = $this->configuration;
        if (!empty($configuration->userKey())) {
            $request = $request->withHeader(
                'user-key',
                $configuration->userKey()
            );
        }

        return $request;
    }
}
