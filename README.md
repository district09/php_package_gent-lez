# district09/gent-lez package

Check if a geolocation (WGS94 or Lambert72) is located within the City of Ghent
Low Emission Zone (LEZ). This is a PHP wrapper around a GIS webservice.

[![Github][github-badge]][github-link]
[![License][license-badge]][license-link]
[![Packagist][packagist-version-badge]][packagist-version-link]

[![CI test main][github-ci-badge-main]][github-ci-link]
[![CI test develop][github-ci-badge-develop]][github-ci-link]

## Install

Install the package using composer:

```bash
composer require district09/gent-lez
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed
recently.

## Examples

See the [examples](examples) directory how to use the service wrappers.

## Testing

Run the test suite:

``` bash
composer install
vendor/bin/grumphp
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.

[github-badge]: https://img.shields.io/badge/github-District09_Gent_LEZ-blue.svg?logo=github&style=flat-square
[github-link]: https://github.com/digipolisgent/php_package_gent-lez

[license-badge]: https://img.shields.io/github/license/digipolisgent/php_package_gent-lez?style=flat-square
[license-link]: LICENSE.md

[packagist-version-badge]: https://img.shields.io/packagist/v/district09/gent-lez?style=flat-square
[packagist-version-link]: https://packagist.org/packages/district09/gent-lez

[github-ci-link]: https://github.com/district09/php_package_gent-lez/actions/workflows/ci.yml
[github-ci-badge-main]: https://img.shields.io/github/actions/workflow/status/district09/php_package_gent-lez/ci.yml?branch=main&style=flat-square&label=Tests%20Main
[github-ci-badge-develop]: https://img.shields.io/github/actions/workflow/status/district09/php_package_gent-lez/ci.yml?branch=develop&style=flat-square&label=Tests%20Develop
