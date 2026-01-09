<?php

declare(strict_types=1);

namespace District09\Tests\Gent\Lez\Value;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\DataProvider;
use District09\Gent\Lez\Value\Properties;
use PHPUnit\Framework\TestCase;

/**
 * Tests District09\Gent\Lez\Value\Properties.
 */
#[CoversClass(Properties::class)]
final class PropertiesTest extends TestCase
{
    /**
     * Properties are created from Gent & UID ID.
     */
    #[Test]
    public function itIsCreatedFromItsDetails(): void
    {
        $properties = Properties::fromGentAndUriId('Foo', 'gent/foo');

        self::assertEquals('Foo', $properties->gentId());
        self::assertEquals('gent/foo', $properties->uriId());
    }

    /**
     * Properties are the same when they share the same Gent & UID ID.
     *
     * @param \District09\Gent\Lez\Value\Properties $otherProperties
     *   The other properties to compare.
     * @param bool $same
     *   Both properties should be the same.
     *
     *
     */
    #[DataProvider('otherPropertiesProvider')]
    #[Test]
    public function itIsSamePropertiesWhenTheyShareSameValues(
        Properties $otherProperties,
        bool $same
    ): void {
        $properties = Properties::fromGentAndUriId('Foo', 'gent/foo');

        self::assertSame($same, $properties->sameValueAs($otherProperties));
    }

    /**
     * Other properties data provider.
     *
     * @retrun array
     *   Rows containing:
     *   - The other properties to compare against.
     *   - Should be the same.
     */
    public static function otherPropertiesProvider(): array
    {
        return [
            'Not the same when the Gent ID is different' => [
                Properties::fromGentAndUriId('Fizz', 'gent/foo'),
                false,
            ],
            'Not the same when the UID ID is different' => [
                Properties::fromGentAndUriId('Foo', 'gent/fizz'),
                false,
            ],
            'Same when Gent and UID ID are the same value' => [
                Properties::fromGentAndUriId('Foo', 'gent/foo'),
                true,
            ],
        ];
    }

    /**
     * The value is casted to string as "gent_id (uid_id)".
     */
    #[Test]
    public function itCanBeCastedToString(): void
    {
        $properties = Properties::fromGentAndUriId('Foo', 'gent/foo');

        self::assertEquals('Foo (gent/foo)', (string) $properties);
    }
}
