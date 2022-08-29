<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;
use District09\Gent\Lez\Value\Geometry\GeometryInterface;

/**
 * A single feature.
 */
class Feature extends ValueAbstract
{
    /**
     * The properties.
     *
     * @var \District09\Gent\Lez\Value\Properties
     */
    private $properties;

    /**
     * The geometry.
     *
     * @var \District09\Gent\Lez\Value\Geometry\GeometryInterface
     */
    private $geometry;

    /**
     * Named constructor only.
     *
     * @see \District09\Gent\Lez\Value\Feature::fromPropertiesAndGeometry()
     */
    private function __construct()
    {
        // See Feature::fromPropertiesAndGeometry().
    }

    /**
     * Create the feature from properties and geometry.
     *
     * @param \District09\Gent\Lez\Value\Properties $properties
     * @param \District09\Gent\Lez\Value\Geometry\GeometryInterface $geometry
     *
     * @return \District09\Gent\Lez\Value\Feature
     */
    public static function fromPropertiesAndGeometry(
        Properties $properties,
        GeometryInterface $geometry
    ): Feature {
        $feature = new Feature();
        $feature->properties = $properties;
        $feature->geometry = $geometry;

        return $feature;
    }

    /**
     * Get the properties.
     *
     * @return \District09\Gent\Lez\Value\Properties
     */
    public function properties(): Properties
    {
        return $this->properties;
    }

    /**
     * Get the geometry.
     *
     * @return \District09\Gent\Lez\Value\Geometry\GeometryInterface
     */
    public function geometry(): GeometryInterface
    {
        return $this->geometry;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \District09\Gent\Lez\Value\Feature $otherFeature */
        $otherFeature = $object;

        return $this->sameValueTypeAs($otherFeature)
            && $this->properties()->sameValueAs($otherFeature->properties())
            && $this->geometry()->sameValueAs($otherFeature->geometry());
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return (string) $this->properties();
    }
}
