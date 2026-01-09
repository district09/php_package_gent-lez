<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\fixtures;

use District09\Gent\Lez\Value\FeaturesInterface;

/**
 * Trait to get the fixtures data for a FeatureCollection.
 */
trait WithFeatureCollectionTrait
{
    /**
     * Get the raw json data.
     *
     * @return string
     */
    protected function getRawJson(): string
    {
        return file_get_contents(__DIR__ . '/FeatureCollection.json');
    }

    /**
     * Get the json decoded data.
     *
     * @return array<int, mixed>
     */
    protected function getDecodedJson(): array
    {
        return json_decode(
            json: $this->getRawJson(),
            flags: JSON_THROW_ON_ERROR
        );
    }

    /**
     * Get the feature collection object representing the raw json data.
     *
     * @return \District09\Gent\Lez\Value\FeaturesInterface
     */
    protected function getFeatureCollection(): FeaturesInterface
    {
        return include __DIR__ . '/FeatureCollection.php';
    }
}
