# FontAwesome PHP Helper

![PHP](https://img.shields.io/badge/PHP-^8.0-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-php-helper/main)

[English](README.md)

## Описание

Пакет предназначен для генерации HTML-кода иконок FontAwesome 6. Кроме того, доступны следующие функции:

- добавление цвета иконок
- изменение размера иконок
- поддержка как современных (`fa-solid fa-`), так и устаревших классов (`fas fa-`)
- использование фиксированной ширины иконок (`fa-fw`) для отображения в списках
- опциональное добавление атрибута `aria-hidden="true"` для скрытия иконок от программ чтения с экрана и т. п.
- получение случайной иконки

## Установка

```bash
composer require bugo/fa-php-helper
```

## Использование

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

// '<i class="fa-regular fa-calendar" title="Календарь"></i>
echo $regularIcon->html('calendar', 'Календарь');

// '<i class="fa-regular fa-copy fa-2xl"></i>'
echo $regularIcon->size('2xl')->html('copy');

// '<i class="fa-brands fa-apple" style="color: red"></i>'
echo $brandIcon->color('red')->html('apple');
```

Добавление фиксированной ширины для отображения в списках:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;

$solidIcon = new SolidIcon();
$solidIcon->useFixedWidth();

// '<i class="fa-solid fa-user fa-fw"></i>'
echo $solidIcon->html('user');
```

Добавление атрибута `aria-hidden="true"`:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;

$solidIcon = new SolidIcon();
$solidIcon->useAriaHidden();

// '<i class="fa-solid fa-user" aria-hidden="true"></i>'
echo $solidIcon->html('user');
```

А дополнительные классы удобно передавать через метод `extra`:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\SolidIcon;

$solidIcon = new SolidIcon();

// '<i class="fa-solid fa-heart fa-beat"></i>'
echo $solidIcon->extra('fa-beat')->html('heart');
```

Кроме того, доступно получение случайной иконки:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\BrandIcon;

$brandIcon = new BrandIcon();

echo $brandIcon->random();
```

А так можно получить всю коллекцию сразу:

```php
<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Collections\Collection;

$collection = new Collection();

echo $collection->getAll();
```

Альтернативный способ работы с иконками через фабрики:

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
