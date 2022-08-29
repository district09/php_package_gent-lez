<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Configuration;

use DigipolisGent\API\Client\Configuration\ConfigurationInterface as BaseConfigurationInterface;

/**
 * Configuration with optional user key value.
 */
interface ConfigurationInterface extends BaseConfigurationInterface
{
    /**
     * Get the API user key (if any).
     *
     * @return string|null
     */
    public function userKey(): ?string;
}
