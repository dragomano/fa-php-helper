<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts\Traits;

use Bugo\FontAwesome\Enums\Type;
use Bugo\FontAwesome\IconBuilder;

trait HasCases
{
    public function brand(string $icon): IconBuilder
    {
        return $this->factory(Type::Brand, $icon);
    }

    public function regular(string $icon): IconBuilder
    {
        return $this->factory(Type::Regular, $icon);
    }

    public function solid(string $icon): IconBuilder
    {
        return $this->factory(Type::Solid, $icon);
    }
}
