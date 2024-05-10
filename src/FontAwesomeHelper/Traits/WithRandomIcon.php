<?php declare(strict_types=1);

/**
 * WithRandomIcon.php
 *
 * @package FontAwesomeHelper
 * @link https://dragomano.ru/fa-php-helper
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/licenses/MIT The MIT License
 *
 * @version 0.3
 */

namespace Bugo\FontAwesomeHelper\Traits;

use Exception;

trait WithRandomIcon
{
    /**
     * @throws Exception
     */
    public function random(): string
    {
        $icons = $this->getAll();
        $index = random_int(0, count($icons) - 1);

        return $this->get($icons[$index]);
    }
}
