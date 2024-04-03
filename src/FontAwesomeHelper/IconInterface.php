<?php declare(strict_types=1);

/**
 * IconInterface.php
 *
 * @package FontAwesomeHelper
 * @link https://dragomano.ru/fa-php-helper
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/licenses/MIT The MIT License
 *
 * @version 0.2
 */

namespace Bugo\FontAwesomeHelper;

interface IconInterface
{
    public function get(string $icon): string;

    public function getAll(): array;
}
