<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Value\Feature;

/**
 * Extracts a Feature value out of json decoded data.
 */
final class FeatureNormalizer
{

    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \District09\Gent\Lez\Value\Feature
     */
    public function normalize(object $jsonData): Feature
    {
        return Feature::fromPropertiesAndGeometry(
            (new PropertiesNormalizer())->normalize($jsonData->properties),
            (new GeometryNormalizer())->normalize($jsonData->geometry)
        );
    }
}
