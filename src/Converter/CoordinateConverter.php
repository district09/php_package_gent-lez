<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Converter;

use District09\Gent\Lez\Value\Geometry\CoordinateInterface;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Wgs84;
use proj4php\Point;
use proj4php\Proj;
use proj4php\Proj4php;

/**
 * Converter to translate Coordinates between different projections.
 */
final class CoordinateConverter
{

    /**
     * The converter.
     *
     * @var \proj4php\Proj4php
     */
    private $transformer;

    /**
     * Create a new converter.
     */
    public function __construct()
    {
        $this->transformer = new Proj4php();
    }

    /**
     * Mapping between Coordinate values and projection types.
     *
     * @var array
     */
    private $mapping = [
        Lambert72::class => 'EPSG:31370',
        Wgs84::class => 'EPSG:4326',
    ];

    /**
     * Convert coordinate to Lambert72 projection.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *
     * @return \District09\Gent\Lez\Value\Geometry\Lambert72
     */
    public function toLambert72(CoordinateInterface $coordinate): Lambert72
    {
        /** @var \District09\Gent\Lez\Value\Geometry\Lambert72 $lambert72 */
        $lambert72 = $this->convertTo($coordinate, Lambert72::class);
        return $lambert72;
    }

    /**
     * Convert coordinate to Wgs84 projection.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *
     * @return \District09\Gent\Lez\Value\Geometry\Wgs84
     */
    public function toWgs84(CoordinateInterface $coordinate): Wgs84
    {
        /** @var \District09\Gent\Lez\Value\Geometry\Wgs84 $wgs84 */
        $wgs84 = $this->convertTo($coordinate, Wgs84::class);
        return $wgs84;
    }

    /**
     * Convert a given coordinate into the requested projection.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *   The coordinate value to transform.
     * @param string $target
     *   The class name of the target format.
     *
     * @return \District09\Gent\Lez\Value\Geometry\CoordinateInterface
     *   The transformed projection.
     */
    private function convertTo(CoordinateInterface $coordinate, string $target): CoordinateInterface
    {
        if ($coordinate instanceof $target) {
            return $coordinate;
        }

        $projectionTo = new Proj($this->mapping[$target], $this->transformer);
        $pointFrom = $this->pointFromCoordinate($coordinate);

        /** @var \proj4php\Point $point */
        $point = $this
            ->transformer
            ->transform($projectionTo, $pointFrom);
        $values = $point->toArray();

        return new $target($values[0], $values[1]);
    }

    /**
     * Get the Point based on the given coordinate.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *
     * @return \proj4php\Point
     */
    private function pointFromCoordinate(CoordinateInterface $coordinate): Point
    {
        $type = $this->mapping[get_class($coordinate)];
        $projection = new Proj($type, $this->transformer);

        return new Point(
            $coordinate->xPosition(),
            $coordinate->yPosition(),
            $projection
        );
    }
}
