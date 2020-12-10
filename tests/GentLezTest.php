<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez;

use DigipolisGent\API\Client\ClientInterface;
use District09\Gent\Lez\GentLez;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Response\LezResponse;
use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\FeaturesInterface;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;
use District09\Gent\Lez\Value\Properties;
use PHPStan\Testing\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @covers \District09\Gent\Lez\GentLez
 */
class GentLezTest extends TestCase
{
    use ProphecyTrait;

    /**
     * Coordinate Inside LEZ.
     *
     * @var \District09\Gent\Lez\Value\Geometry\CoordinateInterface
     */
    private $insideLez;

    /**
     * Coordinate Outside LEZ.
     *
     * @var \District09\Gent\Lez\Value\Geometry\CoordinateInterface
     */
    private $outsideLez;

    /**
     * Inside LEZ feature.
     *
     * @var \District09\Gent\Lez\Value\Feature
     */
    private $insideFeature;

    /**
     * The HTTP client.
     *
     * @var \DigipolisGent\API\Client\ClientInterface
     */
    private $client;

    /**
     * @inheritDoc
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->insideLez = Lambert72::fromXYPosition(999, 999);
        $this->outsideLez = Lambert72::fromXYPosition(0, 0);
        $this->insideFeature = Feature::fromPropertiesAndGeometry(
            Properties::fromGentAndUriId('Foo', 'gent/foo'),
            Polygon::fromCoordinates()
        );

        $insideFeatures = $this->prophesize(FeaturesInterface::class);
        $insideFeatures->hasFeatures()->willReturn(true);
        $insideFeatures->features()->willReturn([$this->insideFeature]);

        $outsideFeatures = $this->prophesize(FeaturesInterface::class);
        $outsideFeatures->hasFeatures()->willReturn(false);

        $client = $this->prophesize(ClientInterface::class);
        $client
            ->send(new LezRequest($this->insideLez))
            ->willReturn(new LezResponse($insideFeatures->reveal()));
        $client
            ->send(new LezRequest($this->outsideLez))
            ->willReturn(new LezResponse($outsideFeatures->reveal()));
        $this->client = $client->reveal();
    }


    /**
     * Geographical LEZ feature is returned or NULL.
     *
     * @test
     */
    public function itReturnsLezFeatureOrNull(): void
    {
        $gentLez = new GentLez($this->client);

        self::assertNull(
            $gentLez->lezByCoordinate($this->outsideLez)
        );
        self::assertSame(
            $this->insideFeature,
            $gentLez->lezByCoordinate($this->insideLez)
        );
    }

    /**
     * True is returned when coordinate is within LEZ.
     *
     * @test
     */
    public function itReturnsIfCoordinateIsWithinLez(): void
    {
        $gentLez = new GentLez($this->client);

        self::assertFalse($gentLez->isCoordinateInLez($this->outsideLez));
        self::assertTrue($gentLez->isCoordinateInLez($this->insideLez));
    }
}
