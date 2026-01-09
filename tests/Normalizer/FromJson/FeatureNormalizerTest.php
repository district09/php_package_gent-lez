<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Normalizer\FromJson;

use District09\Gent\Lez\Normalizer\FromJson\FeatureNormalizer;
use District09\Tests\Gent\Lez\fixtures\WithFeatureCollectionTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Normalizer\FromJson\FeatureNormalizer.
 */
#[CoversClass(FeatureNormalizer::class)]
final class FeatureNormalizerTest extends TestCase
{
    use WithFeatureCollectionTrait;

    /**
     * Feature is extracted from given data.
     */
    #[Test]
    public function itExtractsFeatureFromJsonData(): void
    {
        $json = $this->getDecodedJson();

        $normalizer = new FeatureNormalizer();
        self::assertEquals(
            $this->getFeatureCollection()->features()[0],
            $normalizer->normalize($json[0]->items[0])
        );
    }
}
