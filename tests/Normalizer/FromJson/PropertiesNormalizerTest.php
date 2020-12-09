<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\PropertiesNormalizer;
use District09\Gent\Lez\Value\Properties;

/**
 * @covers \District09\Gent\Lez\Normalizer\FromJson\PropertiesNormalizer
 */
class PropertiesNormalizerTest extends NormalizerTestBase
{

    /**
     * Properties is extracted from given data.
     *
     * @test
     */
    public function itExtractsPropertiesFromJsonData(): void
    {
        $json = $this->getDecodedFeatureCollection();

        $expected = Properties::fromGentAndUriId('LEZ1', 'milieuqa/lez13');

        $normalizer = new PropertiesNormalizer();

        self::assertEquals(
            $expected,
            $normalizer->normalize($json->features[0]->properties)
        );
    }
}
