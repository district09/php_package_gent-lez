<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Value\Geometry;

use DigipolisGent\Value\ValueAbstract;
use DigipolisGent\Value\ValueInterface;

/**
 * Abstract implementation of a geographical coordinate.
 */
class AbstractCoordinate extends ValueAbstract implements CoordinateInterface
{
    /**
     * The x-position.
     *
     * @var float
     */
    private $xPosition;

    /**
     * The y-position.
     *
     * @var float
     */
    private $yPosition;

    /**
     * Create a new coordinate object.
     *
     * @param float $xPosition
     * @param float $yPosition
     */
    public function __construct(float $xPosition, float $yPosition)
    {
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
    }

    /**
     * @inheritDoc
     */
    public function xPosition(): float
    {
        return $this->xPosition;
    }

    /**
     * @inheritDoc
     */
    public function yPosition(): float
    {
        return $this->yPosition;
    }

    /**
     * @inheritDoc
     */
    public function sameValueAs(ValueInterface $object): bool
    {
        /** @var \District09\Gent\Lez\Value\Geometry\CoordinateInterface $otherPoint */
        $otherPoint = $object;

        return $this->sameValueTypeAs($otherPoint)
            && $this->xPosition() === $otherPoint->xPosition()
            && $this->yPosition() === $otherPoint->yPosition();
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return sprintf(
            '%s %s',
            (string) $this->xPosition(),
            (string) $this->yPosition()
        );
    }
}
