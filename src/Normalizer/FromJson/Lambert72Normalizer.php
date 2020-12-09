<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Value\Geometry\Lambert72;

/**
 * Extracts a Lambert72 value out of json decoded data.
 */
final class Lambert72Normalizer
{

    /**
     * Normalize the json data.
     *
     * @param array $jsonData
     *
     * @return \District09\Gent\Lez\Value\Geometry\Lambert72
     */
    public function normalize(array $jsonData): Lambert72
    {
        return Lambert72::fromXYPosition(
            (float) $jsonData[0],
            (float) $jsonData[1]
        );
    }
}
