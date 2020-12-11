<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Configuration;

use District09\Gent\Lez\Configuration\Configuration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \District09\Gent\Lez\Configuration\Configuration
 */
class ConfigurationTest extends TestCase
{
    /**
     * Configuration can be created with user key.
     *
     * @test
     */
    public function configurationCanBeCreatedFromDetails(): void
    {
        $configuration = new Configuration('https://endpoint', 'api-user-key');

        self::assertEquals('https://endpoint', $configuration->getUri());
        self::assertEquals('api-user-key', $configuration->userKey());
    }
}
