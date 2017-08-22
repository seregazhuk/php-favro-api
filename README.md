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
- [Rate limiting](#rate-limiting)
- [Users](#users)
- [Organizations](#organizations)
- [Collections](#collections)
- [Widgets](#widgets)
- [Columns](#columns)
- [Cards](#cards)
- [Tags](#tags)
- [Tasks](#tasks)
- [Tasklists](#tasklists)
- [Comments](#comments)

## Dependencies
Library requires CURL extension and PHP 5.6 or above.

## Installation
Via composer:
```
composer require seregazhuk/favro-api
```

## Quick Start

First of all you need to select your current organization, because nearly all
API requests require the organizationId of the organization that these call are being 
made against. You can set your current organization in two ways: by name or by Id.

```php 
// You may need to amend this path to locate composer's autoloader
require './vendor/autoload.php';

use seregazhuk\Favro\Favro;

$favro = Favro::create('test@example.com', 'test');

// set your organization
$favro->setOrganization("My Organization");

// get all collections
$result = $favro->collections->getAll();
```

You can get all your organization and then set it by id:

```php
// get your organizations
$result = $favro->organizations->getAll();
$organizations = $result['entities'];

// select the first organization
$favro->setOrganization($organizations[0]['organizationId']);
```

## Rate limiting

To get your current rate limit information use *getRateInfo()* method:

```php
$result = $favro->getRateInfo();
print_r($result);

/*
[
    'reset' => 2016-09-03T08:17:24.158Z
    'remaining' => 42
    'limit' => 50
]
*/
```
Result will be an array of three elements:

| Key | Description |
| ---  | --- |
|reset|The time at which the current rate limit window resets in UTC.|
|remaining|The number of requests remaining in the current rate limit window.|
|limit|The maximum number of requests permitted to make per hour.|

More information about rate limiting is available in the [official api docs](https://favro.com/developer/#rate-limiting).

## Users

### [Get all users](https://favro.com/developer/#get-all-users)

```php
$result = $favro->users->getAll();
```

The response will be an array of users:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
            "userId": "67973f72db34592d8fc96c48",
            "name": "Favro user",
            "email": "user@favro.com"
        ]
    ]
]
```

### [Get a user](https://favro.com/developer/#get-a-user)

Arguments: 

| Argument | Type | Description |
| --- | --- | --- |
|userId|string|The id of the user to be retrieved.|

```php
$result = $favro->users->getById($userId);
```
The response returns a user object:

```php
[
    "userId": "67973f72db34592d8fc96c48",
    "name": "Favro user",
    "email": "user@favro.com"
]
```

## Organizations

### [Get all organizations](https://favro.com/developer/#get-all-organizations)

```php
$result = $favro->organizations->getAll();
```
The response will be an array of organizations:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
            "organizationId" : "67973f72db34592d8fc96c48",
            "name" : "My organization",
            "sharedToUsers": [
                [
                    "userId" : "fB6bJr5TbaKLiofns",
                    "role" : "administrator",
                    "joinDate" : "2016-02-10T14:25:58.745Z"
                ]
            ]
        ]
    ]
]
```

### [Get an organization](https://favro.com/developer/#get-an-organization)

Arguments: 

| Argument | Type | Description |
| --- | --- | --- |
|organizationId|string|The id of the organization to be retrieved.|

```php
$result = $favro->organizations->getById($ogranizationId);
```

The response returns an organization object:

```php
[
    "organizationId" : "67973f72db34592d8fc96c48",
    "name" : "My organization",
    "sharedToUsers": [
        [
            "userId" : "fB6bJr5TbaKLiofns",
            "role" : "administrator",
            "joinDate" : "2016-02-10T14:25:58.745Z"
        ]
    ]
]
```

### [Create an organization](https://favro.com/developer/#create-an-organization)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the organization.|
|shareToUsers|array|The users who will be invited to the organization. See below for a description of a user share object.|

`shareToUsers` is also an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|userId|string|The userId of the existing user. Required if email is not provided.|
|email|string|Email. Required if userId is not provided.|
|role|string|The role of the user in the organization. Refer to [organization roles](https://favro.com/developer/#organization-roles). Required.|
|delete|boolean|Removes user from the organization if value equals to true. Optional.|

```php
$result = $favro->organizations->create($attributes);
```

The response will be the created organization:

```php
[
    "organizationId" : "67973f72db34592d8fc96c48",
    "name" : "My organization",
    "sharedToUsers": [
        [
            "userId" : "fB6bJr5TbaKLiofns",
            "role" : "administrator",
            "joinDate" : "2016-02-10T14:25:58.745Z"
        ]
    ]
]
```

### [Update an organization](https://favro.com/developer/#update-an-organization)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|organizationId|string|The id of the organization to update.|
|attributes|array|Array of attributes to be updated.|


`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the organization.|
|members|array|Update user roles in the organization. See below for a description of a user share object.|
|shareToUsers|array|The users who will be invited to the organization. See below for a description of a user share object.|

`shareToUsers` is also an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|userId|string|The userId of the existing user. Required if email is not provided.|
|email|string|Email. Required if userId is not provided.|
|role|string|The role of the user in the organization. Refer to [organization roles](https://favro.com/developer/#organization-roles). Required.|
|delete|boolean|Removes user from the organization if value equals to true. Optional.|

```php
$result = $favro->organizations->update($organizationId, $attributes);
```

The response will be the updated organization:

```php
[
        "organizationId" : "67973f72db34592d8fc96c48",
        "name" : "My organization",
        "sharedToUsers": [
            [
                "userId" : "fB6bJr5TbaKLiofns",
                "role" : "administrator",
                "joinDate" : "2016-02-10T14:25:58.745Z"
            ]
        ]
]
```

## Collections

### [Get all collections](https://favro.com/developer/#get-all-collections)

```php
$result = $favro->collections->getAll();
```

The response will be a paginated list of collections:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [      
            "collectionId": "67973f72db34592d8fc96c48",
            "organizationId": "zk4CJpg5uozhL4R2W",
            "name": "My collection",
            "sharedToUsers": [
                [
                    "userId": "ff440e8f358c08513a86c8d6",
                    "role": "admin"
                ]
            ],
            "publicSharing": "users",
            "background": "purple",
            "archived": false,
            "shareWidgetsByDefault": true
        ]
    ]
]
```

### [Get an collection](https://favro.com/developer/#get-a-collection)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|collectionId|string|The id of the collection to be retrieved.|

```php
$result = $favro->collections->getById($collectionId);
```

The response returns a collection object:
```
[
    "collectionId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "name": "My collection",
    "sharedToUsers": [
        [
            "userId": "ff440e8f358c08513a86c8d6",
            "role": "admin"
        ]
    ],
    "publicSharing": "users",
    "background": "purple",
    "archived": false,
    "shareWidgetsByDefault": true
]
```

### [Create a collection](https://favro.com/developer/#create-a-collection)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the collection. Required.|
|starPage|boolean|Star the collection for authorized user. Defaults to false.|
|shareWidgetsByDefault|boolean|Share widgets to the collection members by default. Defaults to true.|
|publicSharing|string|Public share role for the collection. Refer to [collection public sharing](https://favro.com/developer/#collection-public-sharing).|
|background|string|The background color of the collection. Refer to [collection background](https://favro.com/developer/#collection-background).|
|shareToUsers|array|The users who will be invited to the collection. See below for a description of a user share object.|

`shareToUsers` is also an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|userId|string|The userId of the existing user. Required if email is not provided.|
|email|string|Email. Required if userId is not provided.|
|role|string|The role of the user in the collection. Refer to [collection roles](https://favro.com/developer/#collection-roles). Required.|
|delete|boolean|Removes user from the collection if value equals to true. Optional.|

```php
$result = $favro->collections->create($attributes);
```

The response will be the created collection:
```
[
    "collectionId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "name": "My collection",
    "sharedToUsers": [
        [
            "userId": "ff440e8f358c08513a86c8d6",
            "role": "admin"
        ]
    ],
    "publicSharing": "users",
    "background": "purple",
    "archived": false,
    "shareWidgetsByDefault": true
]
```

### [Update a collection](https://favro.com/developer/#update-a-collection)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|collectionId|string|The id of the collection to update.|
|attributes|array|Array of attributes to be updated.|


`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the collection. Required.|
|starPage|boolean|Star the collection for authorized user. Defaults to false.|
|shareWidgetsByDefault|boolean|Share widgets to the collection members by default. Defaults to true.|
|publicSharing|string|Public share role for the collection. Refer to [collection public sharing](https://favro.com/developer/#collections).|
|background|string|The background color of the collection. Refer to [collection background](https://favro.com/developer/#collection-background).|
|shareToUsers|array|The users who will be invited to the collection. See below for a description of a user share object.|

`shareToUsers` is also an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|userId|string|The userId of the existing user. Required if email is not provided.|
|email|string|Email. Required if userId is not provided.|
|role|string|The role of the user in the collection. Refer to [collection roles](https://favro.com/developer/#collection-roles). Required.|
|delete|boolean|Removes user from the collection if value equals to true. Optional.|

```php
$result = $favro->collections->update($collectionId, $attributes);
```

The response will be the updated collection:

```php
[
    "collectionId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "name": "My collection",
    "sharedToUsers": [
        [
            "userId": "ff440e8f358c08513a86c8d6",
            "role": "admin"
        ]
    ],
    "publicSharing": "users",
    "background": "purple",
    "archived": false,
    "shareWidgetsByDefault": true
]
```

### [Delete a collection](https://favro.com/developer/#delete-a-collection)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|collectionId|string|The id of the collection to be deleted.|

```php
$result = $favro->collections->delete($collectionId);
```

## Widgets

### [Get all widgets](https://favro.com/developer/#get-all-widgets)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|collectionId|string|The id of the collection to filter by. Optional.|
|includePublic|boolean|Include publicly shared widgets. Defaults to false.|

```php
$result = $favro->widgets->getAll();
```

The response will be a paginated array of widgets:

```php
[
     "limit": 100,
     "page": 0,
     "pages": 1,
     "requestId": "8cc57b1d8a218fa639c8a0fa",
     "entities": [
        [
             "widgetCommonId": "67973f72db34592d8fc96c48",
             "organizationId": "zk4CJpg5uozhL4R2W",
             "collectionIds": [
                 "8cc57b1d8a218fa639c8a0fa"
             ],
             "name": "This is a widget",
             "type": "board",
             "publicSharing": "collection",
             "color": "purple",
             "sharedToUsers": [
                [
                    "userId": "tXfWe3MXQqhnnTRtw",
                    "role": "view"
                ]
             ]
         ]
     ]
 ]
```

### [Get a widget](https://favro.com/developer/#get-a-widget)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|widgetCommonId|string|The id of the widget to be retrieved.|

```php
$result = $favro->widgets->getById($widgetCommonId);
```

The response returns a widget object:

```php
[
    "widgetCommonId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "collectionIds": [
        "8cc57b1d8a218fa639c8a0fa"
    ],
    "name": "This is a widget",
    "type": "board",
    "publicSharing": "collection",
    "color": "purple",
    "sharedToUsers": [
        [
            "userId": "tXfWe3MXQqhnnTRtw",
            "role": "view"
        ]
    ]
]
```

[Create a widget](https://favro.com/developer/#create-a-widget)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|collectionId|string|The collectionId of the collection to create the widget in. Required.|
|name|string|The name of the widget. Required.|
|type|string|The type of widget to create. Refer to [widget types](https://favro.com/developer/#widget-types). Required.|
|color|string|The color of the widget icon. Refer to [widget colors](https://favro.com/developer/#widget-colors).|
|publicSharing|string|The public sharing level of the widget. Refer to [widget public sharing](https://favro.com/developer/#widget-public-sharing).|
|shareToUsers|array|The list of users to share the widget to. See below for a description of a user share object.|


`shareToUsers` is also an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|userId|string|The userId of the existing user. Required if email is not provided.|
|email|string|Email. Required if userId is not provided.|
|role|string|The role of the user on the widget. Refer to [widget roles](https://favro.com/developer/#widget-roles). Required.|
|delete|boolean|Removes user from the widget if value equals to true. Optional.|

```php
$result = $favro->widgets->create($attributes); 
```

The response will be the created widget:

```php
[
    "widgetCommonId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "collectionIds": [
        "8cc57b1d8a218fa639c8a0fa"
    ],
    "name": "This is a widget",
    "type": "board",
    "publicSharing": "collection",
    "color": "purple",
    "sharedToUsers": [
        [
            "userId": "tXfWe3MXQqhnnTRtw",
            "role": "view"
        ]
    ]
]
```

### [Update a widget](https://favro.com/developer/#update-a-widget)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|widgetCommonId|string|The common id of the widget to update. Required|
|attributes|array|Array of attributes to be updated.|


`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the widget. Required.|
|archive|boolean|Archive or unarchive widget. Requires collectionId to be specified in the request.|
|collectionId|string|The id of the collection where widget will be archived. Required if archive is included in the request.|
|color|string|The color of widget label. Look at [widget colors](https://favro.com/developer/#widget-colors).|
|publicSharing|number|The public sharing level of the widget. Refer to [widget public sharing](https://favro.com/developer/#widget-public-sharing).|
|members|array|Update user roles on the widget. See below for a description of a user share object.|
|shareToUsers|array|The list of users to share the widget to. See below for a description of a user share object.|


`shareToUsers` is also an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|userId|string|The userId of the existing user. Required if email is not provided.|
|email|string|Email. Required if userId is not provided.|
|role|string|The role of the user on the widget. Refer to [widget roles](https://favro.com/developer/#widget-roles). Required.|
|delete|boolean|Removes user from the widget if value equals to true. Optional.|

```php
$result = $favro->widgets->update($widgetCommonId, $attributes);
```

The response will be the updated widget:

```php
[
        "widgetCommonId": "67973f72db34592d8fc96c48",
        "organizationId": "zk4CJpg5uozhL4R2W",
        "collectionIds": [
            "8cc57b1d8a218fa639c8a0fa"
        ],
        "name": "This is a widget",
        "type": "board",
        "publicSharing": "collection",
        "color": "purple",
        "sharedToUsers": [
            [
                "userId": "tXfWe3MXQqhnnTRtw",
                "role": "view"
            ]
        ]
]
```

### [Delete a widget](https://favro.com/developer/#delete-a-widget)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|widgetCommonId|string|The common id of the widget to be deleted. Required.|
|collectionId|string|The id of collection where widget will be deleted. Optional. If ommitted all instances of the widget will be deleted.|

```php
$favro->widgets->delete($widgetCommonId);

// or

$favro->widgets->delete($widgetCommonId, $collectionId);
```

## Columns

### [Get all columns](https://favro.com/developer/#get-all-columns)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|widgetCommonId|string|The common id of the widget to filter by. Required.|

```php
$result = $favro->columns->getAll($widgetCommonId);
```

The response will be a paginated array of columns:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
        "columnId": "67973f72db34592d8fc96c48",
            "organizationId": "zk4CJpg5uozhL4R2W",
            "widgetCommonId": "ff440e8f358c08513a86c8d6",
            "name": "This is a column",
            "position": 0
        ]
    ]
]
```

### [Get a column](https://favro.com/developer/#get-a-column)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|columnId|string|The id of the column to be retrieved.|

```php
$result = $favro->columns->getById($columnId);
```

The response returns a column object:

```php
[
    "columnId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "widgetCommonId": "ff440e8f358c08513a86c8d6",
    "name": "This is a column",
    "position": 0
]
```

### [Create a column](https://favro.com/developer/#create-a-column)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|widgetCommonId|string|The widgetCommonId to create the column on. Required.|
|name|string|The name of the column. Required.|
|position|string|The position of the column on the widget. By default the column will be placed at the end of the widget. Optional.|

```php
$result = $favro->columns->create($attributes); 
```

The response will be the created column:

```php
[
    "columnId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "widgetCommonId": "ff440e8f358c08513a86c8d6",
    "name": "This is a column",
    "position": 0
]
```

### [Update a column](https://favro.com/developer/#update-a-column)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|columnId|string|The id of the column to update.|
|attributes|array|Array of attributes to be updated.|

`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the column.|
|position|string|The position of the column.|


```php
$result = $favro->columns->update($columnId, $attributes);
```

The response will be the updated column:

```php
[
    "columnId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "widgetCommonId": "ff440e8f358c08513a86c8d6",
    "name": "This is a column",
    "position": 0
]
```

### [Delete a column](https://favro.com/developer/#delete-a-column)

Deleting a column will also delete any cards that exist within that column.

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|columnId|string|The id of the column to be deleted. Required.|

```php
$result = $favro->columns->delete($columnId);
```

## Cards

### [Get Get all cards](https://favro.com/developer/#get-all-cards)

In order to use this endpoint you must specify either todoList or one of cardCommonId, widgetCommonId or collectionId.

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|todoList|boolean|Return cards from todolist only. Defaults to false.|
|cardCommonId|string|The common id of the card to filter by.|
|widgetCommonId|string|The common id of the widget to filter by.|
|collectionId|string|The id of the collection to filter by.|
|unique|boolean|If true, return unique cards only. Defaults to false.|

```php
$result = $favro->cards->getAll($params);
```

The response will be a paginated array of cards:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
        "cardId": "67973f72db34592d8fc96c48",
            "organizationId": "zk4CJpg5uozhL4R2W",
            "widgetCommonId": "ff440e8f358c08513a86c8d6",
            "columnId": "b4d8c6283d9d58f9a39108e7",
            "name": "This is a card"
        ]
    ]
]
```

### [Get a card](https://favro.com/developer/#get-a-card)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|cardId|string|The id of the card to be retrieved. Required.|

```php
$result = $favro->cards->get($cardId);
```

The response returns a card object:

```php
[
    "cardId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "widgetCommonId": "ff440e8f358c08513a86c8d6",
    "columnId": "b4d8c6283d9d58f9a39108e7",
    "name": "This is a card"
]
```

### [Create a card](https://favro.com/developer/#create-a-card)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|widgetCommonId|string|The widgetCommonId to create the card on. One of organizationId, widgetCommonId is required. If not set, the card will be created in the user’s todo list.|
|laneId|string|The laneId to create the card in. This is only applicable if creating the card on a widget that has lanes enabled. Optional.|
|columnId|string|The columnId to create the card in. It must belong to the widget specified in the widgetCommonId parameter. WidgetCommonId is required if this parameter is set.|
|parentCardId|string|If creating a card on a backlog widget, it is possible to create this card as a child of the card specified by this parameter. Optional.|
|name|string|The name of the card. Required.|
|detailedDescription|string|The detailed description of the card. Supports [formatting](https://favro.com/developer/#card-formatting).|
|assignmentIds|array|The list of assignments (array of userIds). Optional.|
|tags|array|The list of tag names or [card tags](https://favro.com/developer/#card-tag) that will be added to card. If current tag is not exist in the organization, it will be created.|
|tagIds|array|The list of tag IDs, that will be added to card.|
|startDate|string|The start date of card. Format ISO-8601.|
|dueDate|string|The due date of card. Format ISO-8601.|
|tasklists|array|The list of card [tasklists](https://favro.com/developer/#card-tasklist).|

```php
$result = $favro->cards->create($attributes); 
```

The response will be the created card:

```php
[
    "cardId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "widgetCommonId": "ff440e8f358c08513a86c8d6",
    "columnId": "b4d8c6283d9d58f9a39108e7",
    "name": "This is a card"
]
```

### [Update a card](https://favro.com/developer/#update-a-card)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|cardId|string|The id of the card to update. Required.|
|attributes|array|Array of attributes to be updated.|

`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the card.|
|detailedDescription|string|The detailed description of the card. Supports [formatting](https://favro.com/developer/#card-formatting).|
|widgetCommonId|string|The widgetCommonId to commit the card in. Optional.|
|laneId|string|The laneId to commit the card in. This is only applicable if creating the card on a widget that has lanes enabled. Optional.|
|columnId|string|The columnId to commit the card in. It must belong to the widget specified in the widgetCommonId parameter. Optional.|
|parentCardId|string|If commiting a card on a backlog widget, it is possible to create this card as a child of the card specified by this parameter. Optional.|
|addAssignmentIds|array|The list of assignments, that will be added to card (array of userIds). Optional.|
|removeAssignmentIds|array|The list of assignments, that will be removed from card (array of userIds). Optional.|
|addTags|array|The list of tag names or [card tags](https://favro.com/developer/#cards) that will be added to the card. If the tag does not exist in the organization it will be created.|
|addTagIds|array|A list of tagIds that will be added to card.|
|removeTags|array|The list of tag names, that will be removed from card.|
|removeTagIds|array|The list of tag IDs, that will be removed from card.|
|startDate|string|The start date of card. Format ISO-8601. If *null*, start date will be removed.|
|dueDate|string|The due date of card. Format ISO-8601. If *null*, due date will be removed.|
|addTasklists|array|The list of card [tasklists](https://favro.com/developer/#cards), that will be added to card.|

```php
$result = $favro->cards->update($cardId, $attributes);
```

The response will be the updated cards:

```php
[
    "cardId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "widgetCommonId": "ff440e8f358c08513a86c8d6",
    "columnId": "b4d8c6283d9d58f9a39108e7",
    "name": "This is a card"
]
```

### [Delete a card](https://favro.com/developer/#delete-a-card)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|cardId|string|The id of card to be deleted. Required.|
|everywhere|boolean|If true, all copies of card will be deleted too. Defaults to false.|

```php
$result = $favro->cards->delete($cardId, $everyWhere);
```

The response returns an array of cardIds for the cards that were deleted.

```php
[
    "67973f72db34592d8fc96c48",
    "67973f72db34592d8fc96c49",
    "67973f72db34592d8fc96c50"
]
```

## Tags

### [Get all tags](https://favro.com/developer/#get-all-tags)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|name|string|The name of the tag to filter by. Optional.|
|color|string|The color of the tag to filter by. Optional.

```php
$result = $favro->tags->getAll($params);
```

The response will be a paginated array of tags:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
            "tagId": "67973f72db34592d8fc96c48",
            "organizationId": "zk4CJpg5uozhL4R2W",
            "name": "My tag",
            "color": "purple"
        ]
    ]
]
```

### [Get a tag](https://favro.com/developer/#get-a-tag)

| Argument | Type | Description |
| --- | --- | --- |
|tagId|string|The id of the tag to be retrieved.|

```php
$result = $favro->tags->get($tagId);
```

The response returns a tag object:

```php
[
        "tagId": "67973f72db34592d8fc96c48",
        "organizationId": "zk4CJpg5uozhL4R2W",
        "name": "My tag",
        "color": "purple"
]
```

### [Create a tag](https://favro.com/developer/#create-a-tag)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|cardCommonId|string|The common id of the card to post the tag on. Required.|
|name|string|The name of the tag. Required.|
|color|string|The color of the tag. If not specified, color will be selected randomly. Refer to [tag colors](https://favro.com/developer/#tags).|

```php
$result = $favro->tags->create($attributes); 
```

The response will be the created tag:

```php
[
    "tagId": "67973f72db34592d8fc96c48",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "name": "My tag",
    "color": "purple"
]
```

### [Update a tag](https://favro.com/developer/#update-a-tag)

 Argument | Type | Description |
| --- | --- | --- |
|tagId|string|The id of the tag to update.|
|attributes|array|Array of attributes to be updated.|

`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the tag to edit. Optional.|
|color|string|The color of the tag to edit. Optional. Refer to [tag colors](https://favro.com/developer/#tags).|

```php
$result = $favro->tags->update($tagId, $attributes);
```

The response will be the updated tag:

```php
[
     "tagId": "67973f72db34592d8fc96c48",
     "organizationId": "zk4CJpg5uozhL4R2W",
     "name": "My tag",
     "color": "purple"
]
```

### [Delete a tag](https://favro.com/developer/#delete-a-tag)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|tagId|string|	The id of the tag to be deleted. Required.|

```php
$result = $favro->tags->delete($tagId);
```

## Tasks

### [Get all tasks](https://favro.com/developer/#get-all-tasks)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|cardCommonId|string|The card common id to filter by. Required.|
|taskListId|string|The task list id to filter by. Optional.|

```php
$result = $favro->tasks->getAll($params);
```

The response will be a paginated array of card tasks:

```php
[  "limit": 100,
     "page": 0,
     "pages": 1,
     "requestId": "8cc57b1d8a218fa639c8a0fa",
     "entities": [
        [
             "taskId": "67973f72db34592d8fc96c48",
             "taskListId": "8cc57b1d8a218fa639c8a0fa",
             "organizationId": "zk4CJpg5uozhL4R2W",
             "cardCommonId": "tXfWe3MXQqhnnTRtw",
             "name": "This is a task",
             "completed": false,
             "position": 0
        ]
     ]
 ]
```

### [Get a task](https://favro.com/developer/#get-a-task)

| Argument | Type | Description |
| --- | --- | --- |
|taskId|string|The id of the task to be retrieved.|

```php
$result = $favro->tasks->get($taskId);
```

The response returns a task object:

```php
[
    "taskId": "67973f72db34592d8fc96c48",
    "taskListId": "8cc57b1d8a218fa639c8a0fa",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "cardCommonId": "tXfWe3MXQqhnnTRtw",
    "name": "This is a task",
    "completed": false,
    "position": 0
]
```

### [Create a task](https://favro.com/developer/#create-a-task)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|taskListId|string|The task list id to post the task on. Required.|
|name|string|The name of the task. Required.|
|position|number|Task position in the task list. Optional.|
|completed|boolean|Task completion state. Optional.|

```php
$result = $favro->tasks->create($attributes); 
```

The response will be the created task:

```php
[
    "taskId": "67973f72db34592d8fc96c48",
    "taskListId": "8cc57b1d8a218fa639c8a0fa",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "cardCommonId": "tXfWe3MXQqhnnTRtw",
    "name": "This is a task",
    "completed": false,
    "position": 0
]
```

### [Update a task](https://favro.com/developer/#update-a-task)

| Argument | Type | Description |
| --- | --- | --- |
|taskId|string|The id of the task to update.|
|attributes|array|Array of attributes to be updated.|

`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the task to edit. Optional.|
|position|string|Task position in the list. Optional.|
|completed|string|Task completion state. Optional.|

```php
$result = $favro->tasks->update($taskId, $attributes); 
```

The response will be the updated task:

```php
[
    "taskId": "67973f72db34592d8fc96c48",
    "taskListId": "8cc57b1d8a218fa639c8a0fa",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "cardCommonId": "tXfWe3MXQqhnnTRtw",
    "name": "This is a task",
    "completed": false,
    "position": 0
]
```

### [Delete a task](https://favro.com/developer/#delete-a-task)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|taskId|string|The id of the task to be deleted. Required.|

```php
$result = $favro->tasks->delete($taskId);
```

## Tasklists

### [Get all tasklists](https://favro.com/developer/#get-all-tasklists)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|cardCommonId|string|The card common id to filter by. Required.|

```php
$result = $favro->tasklists->getAll($cardCommonId);
```

The response will be a paginated array of card task lists:

```php
[
    "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
            "taskListId": "8cc57b1d8a218fa639c8a0fa",
            "organizationId": "zk4CJpg5uozhL4R2W",
            "cardCommonId": "tXfWe3MXQqhnnTRtw",
            "description": "This is a tasklist",
            "position": 0
        ]
    ]
]
```

### [Get a task list](https://favro.com/developer/#get-a-task-list)

| Argument | Type | Description |
| --- | --- | --- |
|taskListId|string|The id of the task list to be retrieved.|

```php
$result = $favro->tasklists->get($taskListId);
```

The response returns a task list object:

```php
[
    "taskListId": "8cc57b1d8a218fa639c8a0fa",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "cardCommonId": "tXfWe3MXQqhnnTRtw",
    "description": "This is a tasklist",
    "position": 0
]
```

### [Create a task list](https://favro.com/developer/#create-a-task-list)

Argument `$attributes` is an array and contains the following values:

| Index | Type | Description |
| --- | --- | --- |
|cardCommonId|string|The card common id to post the task list on. Required|
|name|string|The name of the task list. Required.|
|position|string|Task position of the task list. Optional.|
|tasks|array|The list of [card task](https://favro.com/developer/#card-task). Optional.|

```php
$result = $favro->tasklists->create($attributes); 
```

The response will be the created task list:

```php
[
    "taskListId": "8cc57b1d8a218fa639c8a0fa",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "cardCommonId": "tXfWe3MXQqhnnTRtw",
    "description": "This is a tasklist",
    "position": 0
]
```

### [Update a task list](https://favro.com/developer/#update-a-task-list)

| Argument | Type | Description |
| --- | --- | --- |
|taskId|string|The id of the task list to update.|
|attributes|array|Array of attributes to be updated.|

`attributes` is an array with the following structure:

| Index | Type | Description |
| --- | --- | --- |
|name|string|The name of the task list to edit. Optional.|
|position|number|Task position of the task list. Optional.|

```php
$result = $favro->tasklists->update($taskListId, $attributes); 
```

The response will be the updated task:

```php
[
    "taskListId": "8cc57b1d8a218fa639c8a0fa",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "cardCommonId": "tXfWe3MXQqhnnTRtw",
    "description": "This is a tasklist",
    "position": 0
]
```

### [Delete a task list](https://favro.com/developer/#delete-a-task-list)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|taskListId|string|The id of the task list to be deleted. Required.|

```php
$result = $favro->tasklists->delete($taskListId);
```

## Comments 

### [Get all comments](https://favro.com/developer/#get-all-comments)

Arguments:

| Argument | Type | Description |
| --- | --- | --- |
|cardCommonId|string|The card common id to filter by. Required.|

```php
$result = $favro->comments->getAll($cardCommonId);
```

The response will be a paginated array of comments:

```php
  "limit": 100,
    "page": 0,
    "pages": 1,
    "requestId": "8cc57b1d8a218fa639c8a0fa",
    "entities": [
        [
        "commentId": "67973f72db34592d8fc96c48",
            "cardCommonId": "ff440e8f358c08513a86c8d6",
            "organizationId": "zk4CJpg5uozhL4R2W",
            "userId": "b4d8c6283d9d58f9a39108e7",
            "comment": "This is a comment",
            "created": "2016-04-18T11:18:42.901Z",
            "lastUpdated": "2016-04-18T11:18:42.901Z"
        ]
    ]
```

### [Get a comment](https://favro.com/developer/#get-a-comment)

| Argument | Type | Description |
| --- | --- | --- |
|commentId|string|The id of the comment to be retrieved.|

```php
$result = $favro->comments->get($commentId);
```

The response returns a comment object:

```php
[
    "commentId": "67973f72db34592d8fc96c48",
    "cardCommonId": "ff440e8f358c08513a86c8d6",
    "organizationId": "zk4CJpg5uozhL4R2W",
    "userId": "b4d8c6283d9d58f9a39108e7",
    "comment": "This is a comment",
    "created": "2016-04-18T11:18:42.901Z",
    "lastUpdated": "2016-04-18T11:18:42.901Z"
]
```

### [Create a comment](https://favro.com/developer/#create-a-comment)



## How can I thank you?
Why not star the github repo? I'd love the attention!

Thanks! 
