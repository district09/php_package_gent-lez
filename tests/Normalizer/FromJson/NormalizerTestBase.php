<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use PHPUnit\Framework\TestCase;

class NormalizerTestBase extends TestCase
{
    /**
     * Get the json decoded version oe a FeatureCollection.
     *
     * @return object
     */
    protected function getDecodedFeatureCollection(): object
    {
        return json_decode(
            file_get_contents(
                __DIR__ . '/../../data/FeatureCollection.json'
            )
        );
    }
}
