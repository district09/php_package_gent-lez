<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Configuration;

use DigipolisGent\API\Client\Configuration\Configuration as BaseConfiguration;

/**
 * Configuration with optional user key value.
 */
final class Configuration extends BaseConfiguration implements ConfigurationInterface
{
    /**
     * Create configuration by its parameters.
     *
     * @param string $endpointUri
     *   The base endpoint URI.
     * @param array|null $options
     *    The client options.
     * @param string|null $apiKey
     *   The API key to use (if any).
     */
    public function __construct(
        string $endpointUri,
        ?array $options = [],
        private ?string $apiKey = null,
    ) {
        if (!str_ends_with($endpointUri, '/')) {
            $endpointUri .= '/';
        }
        parent::__construct($endpointUri, $options ?? []);
    }

    /**
     * @inheritDoc
     */
    public function apiKey(): ?string
    {
        return $this->apiKey;
    }
}
