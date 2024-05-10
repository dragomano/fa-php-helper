# FontAwesome PHP Helper

![PHP](https://img.shields.io/badge/PHP-^8.0-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-php-helper/main)

[По-русски](README.ru.md)

## Description

This package is designed to generate HTML code for FontAwesome 6 icons. In addition, the following features are available:

- add icon colors
- resize icons
- support for both modern (`fa-solid fa-`) and deprecated (`fas fa-`) classes.
- use fixed width icons (`fa-fw`) to display in lists
- optionally add the `aria-hidden="true"` attribute to hide icons from screen readers, etc.
- get random icons

## Installation

```bash
composer require bugo/fa-php-helper
```

## Using

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;
use Bugo\FontAwesomeHelper\Styles\RegularIcon;
use Bugo\FontAwesomeHelper\Styles\BrandIcon;

$solidIcon = new SolidIcon();
$regularIcon = new RegularIcon();
$brandIcon = new BrandIcon();

// 'fa-solid fa-user'
echo $solidIcon->get('user');

// '<i class="fa-solid fa-user"></i>'
echo $solidIcon->html('user');

// '<i class="fa-regular fa-calendar" title="Calendar"></i>
echo $regularIcon->html('calendar', 'Calendar');

// '<i class="fa-regular fa-copy fa-2xl"></i>'
echo $regularIcon->size('2xl')->html('copy');

// '<i class="fa-brands fa-apple" style="color: red"></i>'
echo $brandIcon->color('red')->html('apple');
```

Adding a fixed width for display in lists:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;

$solidIcon = new SolidIcon();
$solidIcon->useFixedWidth();

// '<i class="fa-solid fa-user fa-fw"></i>'
echo $solidIcon->html('user');
```

Adding an attribute `aria-hidden="true"`:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;

$solidIcon = new SolidIcon();
$solidIcon->useAriaHidden();

// '<i class="fa-solid fa-user" aria-hidden="true"></i>'
echo $solidIcon->html('user');
```

It is convenient to pass additional classes via `extra` method:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;

$solidIcon = new SolidIcon();

// '<i class="fa-solid fa-heart fa-beat"></i>'
echo $solidIcon->extra('fa-beat')->html('heart');
```

You can also get a random icon:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\BrandIcon;

$brandIcon = new BrandIcon();

echo $brandIcon->random();
```

And so you can get the whole collection at once:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Collections\Collection;

$collection = new Collection();

echo $collection->getAll();
```

An alternative way to work with icons via factories:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Factories\IconFactoryCreator;

$iconFactoryCreator = new IconFactoryCreator();
$iconSolidFactory = $iconFactoryCreator::createFactory('solid');
$solidIcon = $iconSolidFactory->createIcon();

// '<i class="fa-solid fa-heart"></i>'
echo $solidIcon->html('heart');

$iconOldSolidFactory = $iconFactoryCreator::createFactory('old_solid');
$oldSolidIcon = $iconOldSolidFactory->createIcon();

// '<i class="fas fa-heart"></i>'
echo $oldSolidIcon->html('heart');
```
