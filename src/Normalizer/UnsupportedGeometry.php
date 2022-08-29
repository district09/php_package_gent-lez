<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Normalizer;

use Exception;

/**
 * Exception thrown when an unsupported geometry is detected.
 */
final class UnsupportedGeometry extends Exception
{
    /**
     * Create exception from given unsupported type.
     *
     * @param string $type
     *   The geometry type.
     *
     * @return \District09\Gent\Lez\Normalizer\UnsupportedGeometry
     */
    public static function type(string $type): UnsupportedGeometry
    {
        return new self(
            sprintf('Geometry type %s is not supported.', $type),
            400,
        );
    }
}
