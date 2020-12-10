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
    private $converter;

    /**
     * Create a new converter.
     */
    public function __construct()
    {
        $this->converter = new Proj4php();
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
        if ($coordinate instanceof Lambert72) {
            return $coordinate;
        }

        $values = $this
            ->transformTo(
                $coordinate,
                $this->mapping[Lambert72::class]
            );

        return Lambert72::fromXYPosition($values['x'], $values['y']);
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
        if ($coordinate instanceof Wgs84) {
            return $coordinate;
        }

        $values = $this
            ->transformTo(
                $coordinate,
                $this->mapping[Wgs84::class]
            );

        return Wgs84::fromLatitudeLongitude($values['y'], $values['x']);
    }

    /**
     * Convert a given coordinate into the requested format.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *   The coordinate value to transform.
     * @param string $projection
     *   The projection type to transform to.
     *
     * @return array
     *   The x, y values in the requested projection.
     */
    private function transformTo(CoordinateInterface $coordinate, string $projection): array
    {
        $projectionFrom = $this->projectionFromCoordinate($coordinate);
        $projectionTo = new Proj($projection, $this->converter);

        $pointFrom = new Point(
            $coordinate->xPosition(),
            $coordinate->yPosition(),
            $projectionFrom
        );

        /** @var \proj4php\Point $point */
        $point = $this
            ->converter
            ->transform($projectionTo, $pointFrom);

        $values = $point->toArray();

        return [
            'x' => $values[0],
            'y' => $values[1],
        ];
    }

    /**
     * Get a projection based on the given coordinates.
     *
     * @param \District09\Gent\Lez\Value\Geometry\CoordinateInterface $coordinate
     *
     * @return \proj4php\Proj
     */
    private function projectionFromCoordinate(CoordinateInterface $coordinate): Proj
    {
        $type = $this->mapping[get_class($coordinate)];

        return new Proj($type, $this->converter);
    }
}
