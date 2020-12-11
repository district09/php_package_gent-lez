<?php

/**
 * Example how to get the LEZ zone details from given x-y Lambert72 coordinates.
 */

use District09\Gent\Lez\Client\Client;
use District09\Gent\Lez\Configuration\Configuration;
use District09\Gent\Lez\GentLezFactory;
use District09\Gent\Lez\Value\Geometry\Lambert72;

require_once __DIR__ . '/bootstrap.php';

/** @var string $apiEndpoint */
/** @var string $apiUserKey */

printTitle('Get the LEZ details (if any) for a given Lambert72 coordinate.');

$positionX = $argv[1] ?? NULL;
$positionY = $argv[2] ?? NULL;

if (is_null($positionX) || is_null($positionY)) {
    printError('No coordinates provided');
    printText('This script requires an X and Y value as parameters.');
    printText('');
    printStep('Example within the LEZ zone:');
    printText('php %s 104681.5399999991 193912.3299999982', $argv[0]);
    printStep('Example outside the LEZ zone:');
    printText('php %s 104681.5399999991 190912.3299999982', $argv[0]);
    return 1;
}

printStep('Create the API client configuration.');
$configuration = new Configuration($apiEndpoint, $apiUserKey);

printStep('Create the Guzzle client.');
$guzzleClient = new GuzzleHttp\Client(['base_uri' => $configuration->getUri()]);

printStep('Create the HTTP client.');
$client = new Client($guzzleClient, $configuration);

printStep('Create the Service wrapper.');
$service = GentLezFactory::create($client);

printText('');
printStep('Get the LEZ geographical feature by the given Lambert72 coordinates');
$lambert72 = Lambert72::fromXYPosition($positionX, $positionY);
$lezFeature = $service->lezByCoordinate($lambert72);

if (!$lezFeature) {
    printText('˟ This coordinate is not within the Gent LEZ zone.');
    return 0;
}

printText('✓ This coordinate is within LEZ zone:');
printText('  %s', (string) $lezFeature->properties());

printFooter();
