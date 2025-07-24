<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Strategies;

use Bugo\FontAwesome\Contracts\IconParameterStrategy;
use Bugo\FontAwesome\Enums\Size;
use Bugo\FontAwesome\IconBuilder;

use function is_string;

class SizeParameter implements IconParameterStrategy
{
    public function apply(IconBuilder $iconBuilder, mixed $value): void
    {
        $size = is_string($value) ? (Size::tryFrom($value) ?? Size::Default) : $value;

        $iconBuilder->addClass("fa-$size->value");
    }
}
