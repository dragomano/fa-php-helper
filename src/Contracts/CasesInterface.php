<?php declare(strict_types = 1);

namespace Bugo\FontAwesome\Contracts;

use Bugo\FontAwesome\IconBuilder;

interface CasesInterface
{
    public function brand(string $icon): IconBuilder;

    public function regular(string $icon): IconBuilder;

    public function solid(string $icon): IconBuilder;
}
