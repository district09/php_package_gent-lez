<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value;

use DigipolisGent\Value\CollectionAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Collection of features.
 */
class Features extends CollectionAbstract
{

    /**
     * The resource.
     *
     * @var string
     */
    private $resource;

    /**
     * Named constructor only.
     *
     * @see \District09\Gent\Lez\Value\Features::fromResourceAndFeatures()
     */
    private function __construct()
    {
        // See Features::fromResourceAndFeatures().
    }

    /**
     * Create a new collection from the resource and one or more feature items.
     *
     * @param string $resource
     * @param \District09\Gent\Lez\Value\Feature ...$featureItems
     *
     * @return \District09\Gent\Lez\Value\Features
     */
    public static function fromResourceAndFeatures(
        string $resource,
        Feature ...$featureItems
    ): Features {
        $features = new Features();
        $features->resource = $resource;
        $features->values = $featureItems;

        return $features;
    }

    /**
     * Get the resource.
     *
     * @return string
     */
    public function resource(): string
    {
        return $this->resource;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \District09\Gent\Lez\Value\Features $otherFeatures */
        $otherFeatures = $object;

        return $this->resource() === $otherFeatures->resource()
            && parent::sameValueAs($otherFeatures);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return $this->resource;
    }
}
