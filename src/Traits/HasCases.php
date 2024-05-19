<?php declare(strict_types=1);

namespace Bugo\FontAwesomeHelper\Traits;

use Bugo\FontAwesomeHelper\Enums\Type;

trait HasCases
{
    public function brand(string $icon): string
    {
        return $this->factory(Type::Brand, $icon);
    }

    public function regular(string $icon): string
    {
        return $this->factory(Type::Regular, $icon);
    }

    public function solid(string $icon): string
    {
        return $this->factory(Type::Solid, $icon);
    }
}
