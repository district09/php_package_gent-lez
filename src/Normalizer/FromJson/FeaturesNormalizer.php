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
     * @param array $jsonData
     *
     * @return \District09\Gent\Lez\Value\FeaturesInterface
     */
    public function normalize(array $jsonData): FeaturesInterface
    {
        $featureNormalizer = new FeatureNormalizer();
        $features = [];

        $list = reset($jsonData);
        $items = $list->items ?? [];
        foreach ($items as $featureData) {
            $features[] = $featureNormalizer->normalize($featureData);
        }

        return Features::fromResourceAndFeatures(
            $list->resourceName,
            ...$features
        );
    }
}
