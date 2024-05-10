<?php declare(strict_types=1);

/**
 * OldCollection.php
 *
 * @package FontAwesomeHelper
 * @link https://dragomano.ru/fa-php-helper
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/licenses/MIT The MIT License
 *
 * @version 0.3
 */

namespace Bugo\FontAwesomeHelper\Collections;

use Bugo\FontAwesomeHelper\Factories\OldBrandIconFactory;
use Bugo\FontAwesomeHelper\Factories\OldSolidIconFactory;
use Bugo\FontAwesomeHelper\Factories\OldRegularIconFactory;

class OldCollection extends Collection
{
    public function getAll(): array
    {
        $solidIcons = (new OldSolidIconFactory())->createIcon();
        $regularIcons = (new OldRegularIconFactory())->createIcon();
        $brandIcons = (new OldBrandIconFactory())->createIcon();

        return array_merge(
            array_map(static fn($icon): string => $solidIcons->prefix . $icon, $solidIcons->getAll()),
            array_map(static fn($icon): string => $regularIcons->prefix . $icon, $regularIcons->getAll()),
            array_map(static fn($icon): string => $brandIcons->prefix . $icon, $brandIcons->getAll()),
        );
    }
}
