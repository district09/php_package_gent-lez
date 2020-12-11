<?php

/**
 * Example how to get the LEZ zone details from given WGS84 coordinates.
 */

use District09\Gent\Lez\Client\Client;
use District09\Gent\Lez\Configuration\Configuration;
use District09\Gent\Lez\GentLezFactory;
use District09\Gent\Lez\Value\Geometry\Wgs84;

require_once __DIR__ . '/bootstrap.php';

/** @var string $apiEndpoint */
/** @var string $apiUserKey */

printTitle('Get the LEZ details (if any) for a given WGS84 coordinate.');

$latitude = $argv[1] ?? NULL;
$longitude = $argv[2] ?? NULL;

if (is_null($latitude) || is_null($longitude)) {
    printError('No coordinates provided');
    printText('This script requires an latitude and longitude value as parameters.');
    printText('');
    printStep('Example within the LEZ zone:');
    printText('php %s 51.0535958 3.7224103', $argv[0]);
    printStep('Example outside the LEZ zone:');
    printText('php %s 51.0266298 3.7227822', $argv[0]);
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
$wgs84 = Wgs84::fromLatitudeLongitude($latitude, $longitude);
$lezFeature = $service->lezByCoordinate($wgs84);

if (!$lezFeature) {
    printText('˟ This coordinate is not within the Gent LEZ zone.');
    return 0;
}

printText('✓ This coordinate is within LEZ zone:');
printText('  %s', (string) $lezFeature->properties());

printFooter();
