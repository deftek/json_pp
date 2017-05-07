# json_pp - JSON Pretty Printer

The `json_pp` utility prints [JSON](http://www.json.org/) data in a legible, indented format. It provides the most
benefit to people who need to read, inspect, and understand JSON data structures that are not already provided with
separating white space, such as software developers building or consuming JSON-based APIs.

By default, `json_pp` does not escape slashes or multi-byte Unicode characters. These characters may be escaped by
overriding the default encode options with a configuration file. Pretty-printing may be similarly disabled when compact
JSON is needed and the source JSON is already formatted with white space.

## System Requirements

* [PHP](http://php.net/) 5.5.0 or later must be available at the command line in order to run `json_pp`. Users of older
versions of PHP [should seriously consider upgrading](http://php.net/eol.php). PHP 7 or later is required to run the
test suite.
* [Composer](https://getcomposer.org/) is used for automating installation, and it is also possible to manually download
and install this package.

## Installation

To make `json_pp` available to all system users, which may require system administrator (e.g., root) privileges:

    composer global install deftek/json_pp

To make `json_pp` available only for the current system user:

    composer install deftek/json_pp

To include `json_pp` in a project that uses Composer:

    composer require deftek/json_pp
    
To include `json_pp` for development purposes in a project that uses Composer:

    composer require --dev deftek/json_pp

## Usage

### Pretty-print compact JSON contained in a string

    echo '{"foo":{"bar":"baz"}}' | json_pp

Output:

    {
        "foo": {
            "bar": "baz"
        }
    }

### Pretty-print compact JSON contained in a file:

    json_pp < compact.json

### Output compact JSON from pretty-printed source:

    echo pretty.json | json_pp --config=config.compact.php

Where `config.compact.php` contains something like:

    <?php
    return [
        'decode' => 0,
        'depth'  => 512,
        'encode' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
    ];

### Configuration

See `config.default.php` for the default configuration values, and override the values in your own configuration files
as needed.

The configuration file contains three options that are used for controlling arguments to the
[`json_decode()`](http://php.net/json_decode) and [`json_encode()`](http://php.net/json_encode) function calls:

1. `decode`: This value represents the `options` argument for [`json_decode()`](http://php.net/json_decode).
1. `depth`: This value represents the `depth` argument for both [`json_decode()`](http://php.net/json_decode) and
    [`json_encode()`](http://php.net/json_encode).
1. `encode`: This value represents the `options` argument for [`json_encode()`](http://php.net/json_encode).

## Copyright and License

The `json_pp` package is provided under the 3-Clause (aka New or Modified) BSD License. Complete copyright and license
information is available in [LICENSE.txt](LICENSE.txt).

## Issues and Contributing

Issues may be reported and contributions may be accepted within the [contribution guidelines](CONTRIBUTING.md).

## Change Log

Notable changes to `json_pp` are documented in the [change log](CHANGELOG.md).

