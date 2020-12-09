<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Value\Features;
use District09\Gent\Lez\Value\FeaturesInterface;

/**
 * Extracts a Features collection value out of json decoded data.
 */
final class FeaturesNormalizer
{

    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \District09\Gent\Lez\Value\FeaturesInterface
     */
    public function normalize(object $jsonData): FeaturesInterface
    {
        $featureNormalizer = new FeatureNormalizer();
        $features = [];
        foreach ($jsonData->features as $featureData) {
            $features[] = $featureNormalizer->normalize($featureData);
        }

        return Features::fromResourceAndFeatures(
            $jsonData->resource,
            ...$features
        );
    }
}
