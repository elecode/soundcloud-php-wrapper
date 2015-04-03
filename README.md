# SoundCloud API Wrapper in PHP

<a href="https://travis-ci.org/elecode/soundcloud-php-wrapper"><img src="https://travis-ci.org/elecode/soundcloud-php-wrapper.svg"/></a>
<a href="https://scrutinizer-ci.com/g/elecode/soundcloud-php-wrapper"><img src="https://scrutinizer-ci.com/g/elecode/soundcloud-php-wrapper/badges/quality-score.png?b=master"/></a>

BDD style implementation, proof of concept.

[Documentation of public API](docs/ApiIndex.md)

Supported features so far:
* Application password authorization without a connect screen
* Get user id
* Get user tracks

## Installation via composer

```
{
    "require": {
        "elecode/soundcloud-php-wrapper": "dev-master"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "git@github.com:elecode/soundcloud-php-wrapper.git"
        }
    ]
}
```
