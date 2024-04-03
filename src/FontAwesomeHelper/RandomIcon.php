<?php declare(strict_types=1);

/**
 * RandomIcon.php
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

use Exception;

trait RandomIcon
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
