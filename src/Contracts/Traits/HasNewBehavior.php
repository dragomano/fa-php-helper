<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts\Traits;

trait HasNewBehavior
{
    public function fixedWidth(): static
    {
        return $this;
    }
}
