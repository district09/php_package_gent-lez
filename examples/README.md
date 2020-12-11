# Gent LEZ API : Examples

This directory contains examples of how to use the `district09/gent-lez` package
and how to retrieve data from the webservice.

## Install

The examples require the `config.php` file being in place and filled in.

Copy the `config.example.php` file to `config.php` and fill in the
values. Do not alter the example scripts, all variables are defined in
the `config.php` file.

Install the libraries:

```bash
composer install
```

## Examples

* `DetailsFromLambert72.php` : Get the Gent LEZ details (if any) for a given
  Lambert72  x y position.
* `DetailsFromWgs84.php` : Get the Gent LEZ details (if any) for a given WGS84
  latitude longitude.
* `Lambert72InLez.php` : Check if given Lambert72 x y position is within the
  Gent LEZ.
* `Wgs84InLez.php` : Check if given WGS84 latitude longitude is within the Gent
  LEZ.

## Usage

The scripts can only be called from command line. Provide the X Y values for
Lambert72, and Latitude Longitude for WGS84.

Examples:

```bash
php examples/DetailsFromLambert72.php 104681.5399999991 193912.3299999982
php examples/DetailsFromWgs84.php 51.0535958 3.7224103
php examples/Lambert72InLez.php 104681.5399999991 193912.3299999982
php examples/Wgs84InLez.php 51.0535958 3.7224103
```
