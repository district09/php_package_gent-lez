<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Value\Properties;

/**
 * Extracts a properties value out of json decoded data.
 */
final class PropertiesNormalizer
{

    /**
     * Normalize the json data.
     *
     * @param object $jsonData
     *
     * @return \District09\Gent\Lez\Value\Properties
     */
    public function normalize(object $jsonData): Properties
    {
        return Properties::fromGentAndUriId(
            $jsonData->GENTID,
            $jsonData->urid
        );
    }
}
