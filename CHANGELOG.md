# Changelog

All Notable changes to the `district09/gent-lez` package.

## [Unreleased]

### Changed

- VG-2746: Change user-key header to appKey.

## [3.0.0]

### Added

- VG-2746: Add support for NucleusSpatial V2 API.

### Changed

- Change minimal PHP version to 8.3.

### Removed

- VG-2746: Removed support for NucleusSpatial V1 API.

### Updated

- Update district09/qa-php to 2.x.
- Update PHPUnit to 12.x.

## [2.0.0]

### Added

- Add support for PHP 8.x.

### Changed

- Change minimal PHP version to 7.4.

### Updated

- Update digipolisgent/api-client to 3.0.
- Update digipolisgent/value 3.0.

## [1.0.0]

Initial release of the service wrapper.

### Added

- Added service method to get the Gent LEZ details by a given Lambert72 or WGS84
  coordinate.
- Added service method to check if a given Lambert72 or WGS84 coordinate is
  within the Gent Lez.

[3.0.0]: https://github.com/district09/php_package_gent-lez/compare/2.0.0...3.0.0
[2.0.0]: https://github.com/district09/php_package_gent-lez/compare/1.0.0...2.0.0
[1.0.0]: https://github.com/district09/php_package_gent-lez/releases/tag/1.0.0
[Unreleased]: https://github.com/district09/php_package_gent-lez/compare/main...develop
