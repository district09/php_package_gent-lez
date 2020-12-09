# district09/gent-lez package

Check if a geolocation (WGS94 or Lambert72) is located within the City of Ghent
Low Emission Zone (LEZ). This is a PHP wrapper around a GIS webservice.

[![Github][github-badge]][github-link]
[![License][license-badge]][license-link]
[![Packagist][packagist-version-badge]][packagist-version-link]

[![Build Status Master][travis-master-badge]][travis-master-link]
[![Build Status Develop][travis-develop-badge]][travis-develop-link]
[![Maintainability][codeclimate-maint-badge]][codeclimate-maint-link]
[![Test Coverage][codeclimate-cover-badge]][codeclimate-cover-link]

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

[packagist-version-badge]: https://img.shields.io/packagist/v/digipolisgent/php_package_gent-lez?style=flat-square&include_prereleases
[packagist-version-link]: https://packagist.org/packages/digipolisgent/php_package_gent-lez

[travis-master-badge]: https://img.shields.io/travis/com/digipolisgent/php_package_gent-lez/master.svg?label=master&logo=travis&style=flat-square
[travis-master-link]: https://travis-ci.com/digipolisgent/php_package_gent-lez/branches
[travis-develop-badge]: https://img.shields.io/travis/com/digipolisgent/php_package_gent-lez/develop.svg?label=develop&logo=travis&style=flat-square
[travis-develop-link]: https://travis-ci.com/digipolisgent/php_package_gent-lez/branches

[codeclimate-maint-badge]: https://img.shields.io/codeclimate/maintainability/digipolisgent/php_package_gent-lez?logo=code-climate&style=flat-square
[codeclimate-maint-link]: https://codeclimate.com/github/digipolisgent/php_package_gent-lez
[codeclimate-cover-badge]: https://img.shields.io/codeclimate/coverage/digipolisgent/php_package_gent-lez?logo=code-climate&style=flat-square
[codeclimate-cover-link]: https://codeclimate.com/github/digipolisgent/php_package_gent-lez
