# Favro PHP Api

<p align="center">
    <img src="logo.png" alt="Favro PHP Api">
</p>

<p align="center">
<a href="https://travis-ci.org/seregazhuk/php-favro-api"><img src="https://travis-ci.org/seregazhuk/php-favro-api.svg?branch=master"></a>
<a href="https://scrutinizer-ci.com/g/seregazhuk/php-favro-api/?branch=master"><img src="https://scrutinizer-ci.com/g/seregazhuk/php-favro-api/badges/quality-score.png?b=master"></a>
<a href="https://codeclimate.com/github/seregazhuk/php-favro-api"><img src="https://codeclimate.com/github/seregazhuk/php-favro-api/badges/gpa.svg" /></a>
<a href="https://codeclimate.com/github/seregazhuk/php-favro-api/coverage"><img src="https://codeclimate.com/github/seregazhuk/php-favro-api/badges/coverage.svg" /></a>
<a href="https://packagist.org/packages/seregazhuk/favro-api"><img src="https://poser.pugx.org/seregazhuk/favro-api/v/stable"></a>
<a href="https://packagist.org/packages/seregazhuk/favro-api"><img src="https://poser.pugx.org/seregazhuk/favro-api/downloads"></a>
</p>

- [Dependencies](#dependencies)
- [Installation](#installation)
- [Quick Start](#quick-start)

## Dependencies
Library requires CURL extension and PHP 5.5.9 or above.

## Installation
Via composer:
```
composer require "seregazhuk/favro-api:*"
```

## Quick Start

```php 
// You may need to amend this path to locate composer's autoloader
require './vendor/autoload.php';

use seregazhuk\Favro\Favro;

$favro = Favro::create('seregazhuk88@gmail.com', 'Eikah1ei');

// get your organizations
$result = $favro->organizations->getAll();
$organizations = $result['entities'];

// select first organization
$favro->setOrganization($organizations[0]['organizationId']);

// get all collections
$result = $favro->collections->getAll();