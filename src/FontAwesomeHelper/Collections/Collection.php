<?php declare(strict_types=1);

/**
 * Collection.php
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

use Bugo\FontAwesomeHelper\Factories\BrandIconFactory;
use Bugo\FontAwesomeHelper\Factories\SolidIconFactory;
use Bugo\FontAwesomeHelper\Factories\RegularIconFactory;
use Bugo\FontAwesomeHelper\IconCollection;
use Bugo\FontAwesomeHelper\Traits\WithParams;
use Bugo\FontAwesomeHelper\Traits\WithRandomIcon;

class Collection implements IconCollection
{
    use WithParams, WithRandomIcon;

    public function get(string $icon): string
    {
        return $icon;
    }

    public function getAll(): array
    {
        $solidIcons = (new SolidIconFactory())->createIcon();
        $regularIcons = (new RegularIconFactory())->createIcon();
        $brandIcons = (new BrandIconFactory())->createIcon();

        return array_merge(
            array_map(static fn($icon): string => $solidIcons->prefix . $icon, $solidIcons->getAll()),
            array_map(static fn($icon): string => $regularIcons->prefix . $icon, $regularIcons->getAll()),
            array_map(static fn($icon): string => $brandIcons->prefix . $icon, $brandIcons->getAll()),
        );
    }
}
