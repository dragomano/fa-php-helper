<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Strategies;

use Bugo\FontAwesome\Contracts\IconParameterStrategy;
use Bugo\FontAwesome\IconBuilder;

class TitleParameter implements IconParameterStrategy
{
    public function apply(IconBuilder $iconBuilder, mixed $value): void
    {
        $iconBuilder->getIcon()->title = $value;
    }
}
