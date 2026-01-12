<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Configuration;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use District09\Gent\Lez\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Configuration\Configuration.
 */
#[CoversClass(Configuration::class)]
final class ConfigurationTest extends TestCase
{
    /**
     * Configuration can be created with user key.
     */
    #[Test]
    public function itCanBeCreatedFromDetails(): void
    {
        $configuration = new Configuration(
            endpointUri: 'https://endpoint/',
            apiKey: 'api-key',
        );

        self::assertEquals('https://endpoint/', $configuration->getUri());
        self::assertEquals('api-key', $configuration->apiKey());
    }

    /**
     * Slash is automatically added to the endpoint URI.
     */
    #[Test]
    public function itAddsSlashToEndpointUri(): void
    {
        $configuration = new Configuration(
            endpointUri: 'https://endpoint',
            apiKey: 'api-key',
        );

        self::assertEquals('https://endpoint/', $configuration->getUri());
        self::assertEquals('api-key', $configuration->apiKey());
    }

    /**
     * User key is optional.
     */
    #[Test]
    public function itCanBeCreatedWithoutApiUserKey(): void
    {
        $configuration = new Configuration(
            endpointUri: 'https://endpoint/',
        );

        self::assertEquals('https://endpoint/', $configuration->getUri());
        self::assertNull($configuration->apiKey());
    }
}
