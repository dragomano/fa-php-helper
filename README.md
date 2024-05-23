# FontAwesome PHP Helper

![PHP](https://img.shields.io/badge/PHP-^8.1-blue.svg?style=flat)
![Coverage](https://badgen.net/coveralls/c/github/dragomano/fa-php-helper/main)

[По-русски](README.ru.md)

## Description

This package is designed to generate CSS classes and HTML code for FontAwesome 6 icons. In addition, the following features are available:

- add icon colors
- resize icons
- support for both modern (`fa-solid fa-`) and deprecated (`fas fa-`) classes.
- use fixed width icons (`fa-fw`) to display in lists
- optionally add the `aria-hidden="true"` attribute to hide icons from screen readers, etc.
- get CSS class of a random icon
- collection of CSS classes of all icons

## Installation

```bash
composer require bugo/fa-php-helper
```

## Using

If only CSS classes are needed:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

// 'fa-solid fa-user'
echo Icon::V6->solid('user');

// 'fa-regular fa-user'
echo Icon::V6->regular('user');

// 'fa-brands fa-windows'
echo Icon::V6->brand('windows');
```

Advanced example:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

$icon = Icon::V5->brand('windows');

// 'fab fa-windows fa-fw text-red-500'
var_dump(
    $icon
        ->fixedWidth()
        ->color('text-red-500')
        ->text()
);

$icon = Icon::V6->solid('user');

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

Additional classes can be passed through the `addClass` method:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

$icon = Icon::V6->solid('heart');

// '<i class="fa-solid fa-heart fa-beat"></i>'
var_dump(
    $icon
        ->addClass('fa-beat')
        ->html()
);
```

You can also get a random icon:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

var_dump(Icon::V6->random());
```

And so you can get the whole collection with all CSS classes at once:

```php
<?php

use Bugo\FontAwesome\Enums\Icon;

var_dump(Icon::V6->collection());
```
