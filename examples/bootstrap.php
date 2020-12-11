<?php

/**
 * Bootstrap file for all examples.
 */

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('display_startup_errors', true);
date_default_timezone_set('Europe/Brussels');

// CLI only.
if (PHP_SAPI !== 'cli') {
    throw new \Exception(
        'This example should only be run from a Command Line Interface.'
    );
}

// Get the local config file.
$configFile = __DIR__ . '/config.php';
if (!file_exists($configFile)) {
    throw new \Exception(
        'Config file is missing. See examples/README.md how to create one.'
    );
}
require_once __DIR__ . '/config.php';

// AutoLoader to get all required libraries.
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Helper function to print a line to the output.
 *
 * @param string $text
 * @param mixed ...$arguments
 *   Text replacements (see sprintf()).
 */
function printText(string $text, ...$arguments): void
{
    echo $arguments
        ? sprintf($text, ...$arguments)
        : $text;
    echo PHP_EOL;
}

/**
 * Helper to print a separator.
 */
function printLine(): void
{
    printText(str_repeat('-', 80));
}

/**
 * Helper to print a page title.
 *
 * @param string $title
 * @param mixed ...$arguments
 *   Text replacements (see sprintf()).
 */
function printTitle(string $title, ...$arguments): void
{
    printText('');
    printLine();
    printText($title, ...$arguments);
    printLine();
    printText('');
}

/**
 * Helper to print a footer.
 */
function printFooter(): void
{
    printText('');
    printLine();
    printText('');
}

/**
 * Helper to print a step.
 *
 * @param string $step
 * @param mixed ...$arguments
 *   Text replacements (see sprintf()).
 */
function printStep(string $step, ...$arguments): void
{
    printText('→ ' . $step, ...$arguments);
}

/**
 * Helper to print a bullet.
 *
 * @param string $text
 * @param mixed ...$arguments
 *   Text replacements (see sprintf()).
 */
function printBullet(string $text, ...$arguments): void
{
    printText('  • ' . $text, ...$arguments);
}

/**
 * Helper to print an error.
 *
 * @param string $text
 * @param mixed ...$arguments
 *   Text replacements (see sprintf()).
 */
function printError(string $text, ...$arguments): void
{
    $message = 'ERROR : ' . $text;
    printText($message, ...$arguments);
}
