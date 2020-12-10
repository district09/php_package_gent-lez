<?php

declare(strict_types=1);

namespace District09\Gent\Lez;

use DigipolisGent\API\Service\ServiceAbstract;
use District09\Gent\Lez\Request\LezRequest;
use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\Geometry\CoordinateInterface;

/**
 * API wrapper around the webservice to load Gent LEZ zone by coordinate.
 */
final class GentLez extends ServiceAbstract implements GentLezInterface
{

    /**
     * @inheritDoc
     */
    public function lezByCoordinate(CoordinateInterface $coordinate): ?Feature
    {
        $request = new LezRequest($coordinate);

        /** @var \District09\Gent\Lez\Response\LezResponse $response */
        $response = $this->client()->send($request);
        $features = $response->features();

        if (!$features->hasFeatures()) {
            return null;
        }

        return current($features->features());
    }

    /**
     * @inheritDoc
     */
    public function isCoordinateInLez(CoordinateInterface $coordinate): bool
    {
        return $this->lezByCoordinate($coordinate) !== null;
    }
}
