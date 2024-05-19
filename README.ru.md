# FontAwesome PHP Helper

![PHP](https://img.shields.io/badge/PHP-^8.1-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-php-helper/main)

[English](README.md)

## Описание

Пакет предназначен для генерации CSS-классов и HTML-кода иконок FontAwesome 6. Кроме того, доступны следующие функции:

- добавление цвета иконок
- изменение размера иконок
- поддержка как современных (`fa-solid fa-`), так и устаревших классов (`fas fa-`)
- использование фиксированной ширины иконок (`fa-fw`) для отображения в списках
- опциональное добавление атрибута `aria-hidden="true"` для скрытия иконок от программ чтения с экрана и т. п.
- получение CSS-класса случайной иконки
- коллекция CSS-классов всех иконок

## Установка

```bash
composer require bugo/fa-php-helper
```

## Использование

Если нужны только классы:

```php
<?php

use Bugo\FontAwesomeHelper\Enums\Icon;

// 'fa-solid fa-user'
var_dump(Icon::V6->solid('user'));

// 'fa-regular fa-user'
var_dump(Icon::V6->regular('user'));

// 'fab fa-windows'
var_dump(Icon::V5->brand('windows'));
```

Расширенный пример:

```php
<?php

use Bugo\FontAwesomeHelper\Enums\Icon;
use Bugo\FontAwesomeHelper\IconBuilder;

$icon = Icon::V5->brand('windows');
$builder = new IconBuilder($icon);

// 'fab fa-windows fa-fw text-red-500'
var_dump(
    $builder
        ->fixedWidth()
        ->color('text-red-500')
        ->text()
);

$icon = Icon::V6->solid('user');
$builder = new IconBuilder($icon);

// '<i class="fa-solid fa-user fa-2xl" style="color:red" title="Пользователь" aria-hidden="true"></i>'
var_dump(
    $builder
        ->color('red')
        ->size('2xl')
        ->title('Пользователь')
        ->ariaHidden()
        ->html()
);
```

Дополнительные классы можно передать через метод `addClass`:

```php
<?php

use Bugo\FontAwesomeHelper\Enums\Icon;
use Bugo\FontAwesomeHelper\IconBuilder;

$icon = Icon::V6->solid('heart');
$builder = new IconBuilder($icon);

// '<i class="fa-solid fa-heart fa-beat"></i>'
var_dump(
    $builder
        ->addClass('fa-beat')
        ->html()
);
```

Кроме того, доступно получение случайной иконки:

```php
<?php

use Bugo\FontAwesomeHelper\Enums\Icon;

var_dump(Icon::V6->random());
```

А так можно получить всю коллекцию со всеми классами сразу:

```php
<?php

use Bugo\FontAwesomeHelper\Enums\Icon;

var_dump(Icon::V6->collection());
```
