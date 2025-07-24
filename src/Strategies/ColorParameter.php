<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Strategies;

use Bugo\FontAwesome\Contracts\IconParameterStrategy;
use Bugo\FontAwesome\IconBuilder;
use InvalidArgumentException;

use function preg_match;
use function str_starts_with;

class ColorParameter implements IconParameterStrategy
{
    public function apply(IconBuilder $iconBuilder, mixed $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Color cannot be empty');
        }

        $value = (string) $value;

        if (str_starts_with($value, 'text-')) {
            $iconBuilder->addClass($value);

            return;
        }

        if (
            preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value)
            || preg_match('/^[a-zA-Z]+$/', $value)
        ) {
            $iconBuilder->getIcon()->style['color'] = $value;
        } else {
            throw new InvalidArgumentException('Invalid color format');
        }
    }
}
