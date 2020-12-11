<?php

/**
 * Example how to check if Lambert72 coordinate is within Gent LEZ.
 */

use District09\Gent\Lez\Client\Client;
use District09\Gent\Lez\Configuration\Configuration;
use District09\Gent\Lez\GentLezFactory;
use District09\Gent\Lez\Value\Geometry\Wgs84;

require_once __DIR__ . '/bootstrap.php';

/** @var string $apiEndpoint */
/** @var string $apiUserKey */

printTitle('Check if given WGS84 coordinate is within Gent LEZ.');

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
printStep('Check if WGS84 coordinate is within Gent LEZ');
$wgs84 = Wgs84::fromLatitudeLongitude($latitude, $longitude);

if (!$service->isCoordinateInLez($wgs84)) {
    printText('˟ This coordinate is not within the Gent LEZ zone.');
    return 0;
}

printText('✓ This coordinate is within LEZ zone.');

printFooter();
