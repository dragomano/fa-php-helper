<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Strategies;

use Bugo\FontAwesome\Contracts\IconParameterStrategy;
use Bugo\FontAwesome\Enums\Param;
use Bugo\FontAwesome\IconBuilder;

class AriaHiddenParameter implements IconParameterStrategy
{
    public function apply(IconBuilder $iconBuilder, mixed $value): void
    {
        if ($value) {
            $iconBuilder
                ->getIcon()
                ->setAttribute(Param::ARIA_HIDDEN->value, 'true');
        }
    }
}
