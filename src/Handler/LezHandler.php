<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Handler;

use DigipolisGent\API\Client\Handler\HandlerInterface;
use DigipolisGent\API\Client\Response\ResponseInterface;
use District09\Gent\Lez\Normalizer\FromJson\FeaturesNormalizer;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Response\LezResponse;
use Psr\Http\Message as Psr;

/**
 * Handles the LEZ request and transforms it into a response.
 */
final class LezHandler implements HandlerInterface
{
    /**
     * @inheritDoc
     */
    public function handles(): array
    {
        return [LezRequest::class];
    }

    /**
     * @inheritDoc
     */
    public function toResponse(Psr\ResponseInterface $response): ResponseInterface
    {
        $data = json_decode($response->getBody()->getContents());
        $normalizer = new FeaturesNormalizer();

        return new LezResponse(
            $normalizer->normalize($data)
        );
    }
}
