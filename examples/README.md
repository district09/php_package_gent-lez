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

* `101-LookupLambert72.php` : Check if Lambert72 coordinates are located within
  the LEZ zone.
* `102-LookupWgs84.php` : Check if WGS84 coordinates are located within the LEZ
  zone.

## Usage

The scripts can only be called from command line.

Example:

```bash
php 101-LookupLambert72.php
```
