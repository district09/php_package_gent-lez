<?php

declare(strict_types=1);

namespace District09\Gent\Lez\Response;

use DigipolisGent\API\Client\Response\ResponseInterface;
use District09\Gent\Lez\Value\FeaturesInterface;

/**
 * Response containing the returned features.
 */
final class LezResponse implements ResponseInterface
{

    /**
     * The Features collection.
     *
     * @var \District09\Gent\Lez\Value\FeaturesInterface
     */
    private $features;

    /**
     * Create new response from the returned features.
     *
     * @param \District09\Gent\Lez\Value\FeaturesInterface $features
     */
    public function __construct(FeaturesInterface $features)
    {
        $this->features = $features;
    }

    /**
     * Get the features.
     *
     * @return \District09\Gent\Lez\Value\FeaturesInterface
     */
    public function features(): FeaturesInterface
    {
        return $this->features;
    }
}
