<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use Webmozart\Assert\Assert;

/**
 * WGS84 representation of a geographical coordinate.
 */
final class Wgs84 extends AbstractCoordinate
{
    /**
     * Create new WGS84 coordinate from its latitude & longitude.
     *
     * @param float $latitude
     * @param float $longitude
     *
     * @return \District09\Gent\Lez\Value\Geometry\Wgs84
     *   The created WGS84 coordinate.
     */
    public static function fromLatitudeLongitude(float $latitude, float $longitude): Wgs84
    {
        Assert::greaterThanEq($longitude, -180);
        Assert::lessThanEq($longitude, 180);
        Assert::greaterThanEq($latitude, -90);
        Assert::lessThanEq($latitude, 90);

        return new self($longitude, $latitude);
    }

    /**
     * @inheritDoc
     *
     * The string will contain "[latitude (y)] [longitude (x)]".
     */
    public function __toString(): string
    {
        return sprintf(
            '%s %s',
            $this->yPosition(),
            $this->xPosition()
        );
    }
}
