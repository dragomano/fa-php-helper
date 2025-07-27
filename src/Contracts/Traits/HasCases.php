<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts\Traits;

use Bugo\FontAwesome\Enums\Style;
use Bugo\FontAwesome\IconBuilder;

trait HasCases
{
    public function brand(string $icon): IconBuilder
    {
        return $this->factory(Style::Brands, $icon);
    }

    public function regular(string $icon): IconBuilder
    {
        return $this->factory(Style::Regular, $icon);
    }

    public function solid(string $icon): IconBuilder
    {
        return $this->factory(Style::Solid, $icon);
    }
}
