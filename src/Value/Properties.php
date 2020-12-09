<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Feature properties.
 */
final class Properties extends ValueAbstract
{

    /**
     * The gent id.
     *
     * @var string
     */
    private $gentId;

    /**
     * The URI ID.
     *
     * @var string
     */
    private $uriId;

    /**
     * Use named constructor only.
     *
     * @see \District09\Gent\Lez\Value\Properties::fromGentAndUriId()
     */
    private function __construct()
    {
        // See Feature::fromGentAndUriId().
    }

    /**
     * Get the Gent ID.
     *
     * @return string
     */
    public function gentId(): string
    {
        return $this->gentId;
    }

    /**
     * Get the URI ID.
     *
     * @return string
     */
    public function uriId(): string
    {
        return $this->uriId;
    }

    /**
     * Create new properties from Gent ID & URI ID.
     *
     * @param string $gentId
     * @param string $uriId
     *
     * @return \District09\Gent\Lez\Value\Properties
     */
    public static function fromGentAndUriId(string $gentId, string $uriId): Properties
    {
        $properties = new Properties();
        $properties->gentId = $gentId;
        $properties->uriId = $uriId;

        return $properties;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \District09\Gent\Lez\Value\Properties $otherProperties */
        $otherProperties = $object;

        return $this->sameValueTypeAs($otherProperties)
            && $this->gentId() === $otherProperties->gentId()
            && $this->uriId() === $otherProperties->uriId();
    }

    /**
     * @inheritDoc
     *
     * Will return "gentId (uriId)"
     */
    public function __toString(): string
    {
        return sprintf(
            '%s (%s)',
            $this->gentId(),
            $this->uriId()
        );
    }
}
