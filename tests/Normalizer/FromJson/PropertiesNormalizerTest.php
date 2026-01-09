<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\PropertiesNormalizer;
use District09\Tests\Gent\Lez\fixtures\WithFeatureCollectionTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\PropertiesNormalizer.
 */
#[CoversClass(PropertiesNormalizer::class)]
final class PropertiesNormalizerTest extends TestCase
{
    use WithFeatureCollectionTrait;

    /**
     * Properties is extracted from given data.
     */
    #[Test]
    public function itExtractsPropertiesFromJsonData(): void
    {
        $json = $this->getDecodedJson();

        $normalizer = new PropertiesNormalizer();
        self::assertEquals(
            $this->getFeatureCollection()->features()[0]->properties(),
            $normalizer->normalize($json[0]->items[0])
        );
    }
}
