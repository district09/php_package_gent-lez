<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez;

use DigipolisGent\API\Client\ClientInterface;
use District09\Gent\Lez\GentLez;
use District09\Gent\Lez\GentLezFactory;
use District09\Gent\Lez\Handler\LezHandler;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \District09\Gent\Lez\GentLezFactory
 */
class GentLezFactoryTest extends TestCase
{
    use ProphecyTrait;

    /**
     * The factored client contains all handlers.
     *
     * @test
     */
    public function factoredClientContainsAllHandlers(): void
    {
        $client = $this->prophesize(ClientInterface::class);
        $client
            ->addHandler(new LezHandler())
            ->shouldBeCalled();
        $client = $client->reveal();

        $factory = new GentLezFactory();
        $expected = new GentLez($client);

        self::assertEquals($expected, $factory::create($client));
    }
}
