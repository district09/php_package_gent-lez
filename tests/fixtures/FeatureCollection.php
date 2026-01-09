<?php

declare(strict_types=1);

use District09\Gent\Lez\Value\Feature;
use District09\Gent\Lez\Value\Features;
use District09\Gent\Lez\Value\Geometry\Coordinates;
use District09\Gent\Lez\Value\Geometry\Lambert72;
use District09\Gent\Lez\Value\Geometry\Polygon;
use District09\Gent\Lez\Value\Properties;

return Features::fromResourceAndFeatures(
    'Gent.LEZ',
    Feature::fromPropertiesAndGeometry(
        Properties::fromGentAndUriId('LEZ1', 'milieu/lez11'),
        Polygon::fromCoordinates(
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(105480.21567926178, 192222.4694100318),
                Lambert72::fromXYPosition(105480.27274971509, 192222.471295981),
                Lambert72::fromXYPosition(105480.32961947982, 192222.47643634162)
            ),
            Coordinates::fromLambert72(
                Lambert72::fromXYPosition(105607.66012646073, 192253.3581606365),
                Lambert72::fromXYPosition(105607.6645355909, 192253.411385992),
                Lambert72::fromXYPosition(105607.66609680449, 192253.46477083542)
            )
        )
    )
);
