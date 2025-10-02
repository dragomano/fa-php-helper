<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts;

interface IconInterface
{
    public function getAll(int $version = 7): array;
}
