<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts;

use Bugo\FontAwesome\IconBuilder;

interface IconParameterStrategy
{
    public function apply(IconBuilder $iconBuilder, mixed $value): void;
}
