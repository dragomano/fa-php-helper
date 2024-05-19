<?php declare(strict_types=1);

namespace Bugo\FontAwesomeHelper\Interfaces;

interface RandomAwareInterface
{
    public function random(): string;
}
