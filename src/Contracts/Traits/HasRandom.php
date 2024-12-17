<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts\Traits;

use Exception;

use function count;
use function random_int;

trait HasRandom
{
    /**
     * @throws Exception
     */
    public function random(): string
    {
        $icons = $this->collection();
        $index = random_int(0, count($icons) - 1);

        return (string) $icons[$index];
    }
}
