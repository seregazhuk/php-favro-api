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
- [Users](#users)
- [Organizations](#organizations)
- [Collections](#collections)

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
```

## Users

[Get all users](https://favro.com/developer/#get-all-users):
```php
$result = $favro->users->getAll();
```

[Get a user](https://favro.com/developer/#get-a-user):
```php
$result = $favro->users->getById($userId);
```

## Organizations

[Get all organizations](https://favro.com/developer/#get-all-organizations):
```php
$result = $favro->organizations->getAll();
```

[Get an organization](https://favro.com/developer/#get-an-organization):
```php
$result = $favro->organizations->getById($ogranizationId);
```

[Create an organization](https://favro.com/developer/#create-an-organization):
```php
$result = $favro->organizations->create($attributes);
```

[Update an organization](https://favro.com/developer/#update-an-organization):
```php
$result = $favro->organizations->update($organizationId, $attributes);
```

## Collections

[Get all collections](https://favro.com/developer/#get-all-collections):
```php
$result = $favro->collections->getAll();
```

[Get an collection](https://favro.com/developer/#get-a-collection):
```php
$result = $favro->collections->getById($collectionId);
```

[Create a collection](https://favro.com/developer/#create-a-collection):
```php
$result = $favro->collections->create($attributes);
```

[Update a collection](https://favro.com/developer/#update-a-collection):
```php
$result = $favro->collections->update($collectionId, $attributes);
```

[Delete a collection](https://favro.com/developer/#delete-a-collection):
```php
$result = $favro->collections->delete($collectionId);
```