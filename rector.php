<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\PHPUnit\Set\PHPUnitSetList;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/examples',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    //->withPhpSets(php83: true)
    ->withSets([
      PhpUnitSetList::PHPUNIT_100,
      PhpUnitSetList::PHPUNIT_110,
      PhpUnitSetList::PHPUNIT_120,
    ])
    ->withImportNames(importDocBlockNames: false)
    ->withTypeCoverageLevel(0);
