<?php declare(strict_types=1);

/**
 * OldSolidIconFactory.php
 *
 * @package FontAwesomeHelper
 * @link https://dragomano.ru/fa-php-helper
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/licenses/MIT The MIT License
 *
 * @version 0.3
 */

namespace Bugo\FontAwesomeHelper\Factories;

use Bugo\FontAwesomeHelper\IconInterface;
use Bugo\FontAwesomeHelper\Styles\OldSolidIcon;

class OldSolidIconFactory extends IconFactory
{
    public function createIcon(): IconInterface
    {
        return new OldSolidIcon();
    }
}
