<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Request;

use DigipolisGent\API\Client\Request\AcceptType;
use DigipolisGent\API\Client\Request\MethodType;
use GuzzleHttp\Psr7\Request;

/**
 * Abstract request.
 */
abstract class AbstractJsonRequest extends Request
{
    /**
     * Constructor.
     *
     * @param string $uri
     *   The URI for the request object.
     */
    public function __construct(string $uri)
    {
        parent::__construct(
            MethodType::GET,
            $uri,
            ['Accept' => AcceptType::JSON]
        );
    }
}
