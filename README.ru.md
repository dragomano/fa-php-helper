# FontAwesome PHP Helper

![PHP](https://img.shields.io/badge/PHP-^8.1-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-php-helper/main)

[English](README.md)

## Описание

Пакет предназначен для генерации HTML-кода иконок FontAwesome 7. Доступны следующие функции:

- добавление цвета иконок
- изменение размера иконок
- поддержка как современных (`fa-solid fa-`), так и устаревших классов (`fas fa-`)
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

use Bugo\FontAwesome\Enums\Icon;

// 'fa-solid fa-user'
echo Icon::V7->solid('user');

// 'fa-regular fa-user'
echo Icon::V7->regular('user');

// 'fa-brands fa-windows'
echo Icon::V7->brand('windows');
```

Расширенный пример:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

$icon = Icon::V7->solid('user');

// '<i class="fa-solid fa-user fa-2xl" style="color:red" title="Пользователь" aria-hidden="true"></i>'
var_dump(
    $icon
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

use Bugo\FontAwesome\Enums\Icon;

$icon = Icon::V7->solid('heart');

// '<i class="fa-solid fa-heart fa-beat"></i>'
var_dump(
    $icon
        ->addClass('fa-beat')
        ->html()
);
```

Кроме того, доступно получение случайной иконки:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

var_dump(Icon::V7->random());
```

А так можно получить всю коллекцию со всеми классами сразу:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

var_dump(Icon::V7->collection());
```
