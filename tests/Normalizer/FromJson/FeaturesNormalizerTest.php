<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\FeaturesNormalizer;
use District09\Tests\Gent\Lez\fixtures\WithFeatureCollectionTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\FeaturesNormalizer.
 */
#[CoversClass(FeaturesNormalizer::class)]
final class FeaturesNormalizerTest extends TestCase
{
    use WithFeatureCollectionTrait;

    /**
     * Features is extracted from given data.
     */
    #[Test]
    public function itExtractsFeaturesFromJsonData(): void
    {
        $normalizer = new FeaturesNormalizer();
        self::assertEquals(
            $this->getFeatureCollection(),
            $normalizer->normalize($this->getDecodedJson())
        );
    }
}
