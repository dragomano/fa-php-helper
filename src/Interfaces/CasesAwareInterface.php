<?php declare(strict_types = 1);

namespace Bugo\FontAwesomeHelper\Interfaces;

interface CasesAwareInterface
{
    public function brand(string $icon): string;

    public function regular(string $icon): string;

    public function solid(string $icon): string;
}
