<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Request;

use District09\Gent\Lez\Converter\CoordinateConverter;
use District09\Gent\Lez\Value\Geometry\CoordinateInterface;
use District09\Gent\Lez\Value\Geometry\Lambert72;

/**
 * Get the LEZ zone(s) (features) for the given geographical coordinates.
 */
final class LezRequest extends AbstractJsonRequest
{

    /**
     * Create a new request for the given coordinates.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinates
     */
    public function __construct(CoordinateInterface $coordinates)
    {
        $lambert72 = $this->convertToLambert72($coordinates);

        $uri = sprintf(
            'pbuffer?wkid=31370&pointx=%s&pointy=%s&bufferdistance=1',
            $lambert72->xPosition(),
            $lambert72->yPosition()
        );

        parent::__construct($uri);
    }

    /**
     * Convert the coordinates to Lambert72.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinates
     *
     * @return \District09\Gent\Lez\Value\Geometry\Lambert72
     */
    private function convertToLambert72(CoordinateInterface $coordinates): Lambert72
    {
        $converter = new CoordinateConverter();
        return $converter->toLambert72($coordinates);
    }
}
