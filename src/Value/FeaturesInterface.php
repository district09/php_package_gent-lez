<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value;

use DigipolisGent\Value\CollectionInterface;

interface FeaturesInterface extends CollectionInterface
{

    /**
     * Get the features resource id.
     *
     * @return string
     */
    public function resource(): string;

    /**
     * Get the features from the collection.
     *
     * @return \District09\Gent\Lez\Value\Feature[]
     */
    public function features(): array;

    /**
     * Has the features collection any features.
     *
     * @return bool
     */
    public function hasFeatures(): bool;
}
