<?php

declare(strict_types=1);

namespace District09\Gent\Lez;

use DigipolisGent\API\Client\ClientInterface;
use District09\Gent\Lez\Handler\LezHandler;

/**
 * Factory to get the GentLez service.
 */
final class GentLezFactory
{
    /**
     * @param \DigipolisGent\API\Client\ClientInterface $client
     *
     * @return \District09\Gent\Lez\GentLezInterface
     */
    public static function create(ClientInterface $client): GentLezInterface
    {
        $client->addHandler(new LezHandler());

        return new GentLez($client);
    }
}
