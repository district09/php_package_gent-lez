<?php

declare(strict_types=1);

namespace District09\Gent\Lez;

use DigipolisGent\API\Cache\CacheableInterface;
use DigipolisGent\API\Logger\LoggableInterface;
use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\Geometry\CoordinateInterface;

/**
 * Describes the LEZ service wrapper.
 */
interface GentLezInterface extends CacheableInterface, LoggableInterface
{
    /**
     * Get the LEZ zone, if any, for a given coordinate.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *
     * @return \District09\Gent\Lez\Value\Feature
     *   The Geometrical feature describing the LEZ zone.
     */
    public function lezByCoordinate(CoordinateInterface $coordinate): ?Feature;

    /**
     * Is the given coordinate within the Gent Low Emission Zone.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *
     * @return bool
     */
    public function isCoordinateInLez(CoordinateInterface $coordinate): bool;
}
