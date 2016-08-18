# Favro PHP Api

<p align="center">
    <img src="logo.png" alt="Favro PHP Api">
</p>

<p align="center">
<a href="https://travis-ci.org/seregazhuk/php-smsintel-api"><img src="https://travis-ci.org/seregazhuk/php-smsintel-api.svg?branch=master"></a>
<a href="https://scrutinizer-ci.com/g/seregazhuk/php-smsintel-api/?branch=master"><img src="https://scrutinizer-ci.com/g/seregazhuk/php-smsintel-api/badges/quality-score.png?b=master"></a>
<a href="https://codeclimate.com/github/seregazhuk/php-smsintel-api"><img src="https://codeclimate.com/github/seregazhuk/php-smsintel-api/badges/gpa.svg" /></a>
<a href="https://codeclimate.com/github/seregazhuk/php-smsintel-api/coverage"><img src="https://codeclimate.com/github/seregazhuk/php-smsintel-api/badges/coverage.svg" /></a>
<a href="https://packagist.org/packages/seregazhuk/smsintel-api"><img src="https://poser.pugx.org/seregazhuk/smsintel-api/v/stable"></a>
<a href="https://packagist.org/packages/seregazhuk/smsintel-api"><img src="https://poser.pugx.org/seregazhuk/smsintel-api/downloads"></a>
</p>

Library provides common interface for making requests to both XML and JSON [smsintel API](http://www.smsintel.ru/integration/).

- [Dependencies](#dependencies)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Sending messages](#sending-messages)
- [Groups and contacts](#groups-and-contacts)
- [Account](#account)
- [Reports](#reports)

## Dependencies
Library requires CURL extension and PHP 5.5.9 or above.

## Installation
Via composer:
```
composer require "seregazhuk/smsintel-api:*"
```

## Quick Start

```php 
// You may need to amend this path to locate composer's autoloader
require('vendor/autoload.php'); 

use seregazhuk\SmsIntel\SmsIntel;

$sender = SmsIntel::create('login', 'password');

// send sms
$result = $sender->send('phoneNumber', 'From', 'Your message text');

```