<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Styles;

use Bugo\FontAwesome\Contracts\IconInterface;

use function array_merge;

abstract class AbstractStyle implements IconInterface
{
    public function getAll(int $version = 7): array
    {
        return match ($version) {
            5 => static::V5,
            6 => array_merge(static::V5, static::ADDED_IN_V6),
            default => array_merge(static::V5, static::ADDED_IN_V6, static::ADDED_IN_V7),
        };
    }
}
