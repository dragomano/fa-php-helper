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
 * @version 0.2
 */

namespace Bugo\FontAwesomeHelper;

class Collection
{
    use RandomIcon;

    protected array $params = [
        'deprecated_class' => false,
        'fixed_width' => false,
        'aria_hidden' => true,
    ];

    public function __construct(array $params = [])
    {
	    $this->params = array_merge($this->params, $params);
    }

    public function get(string $icon): string
    {
        return $icon;
    }

    public function getAll(): array
    {
        $solidIcons = new SolidIcon($this->params);
        $regularIcons = new RegularIcon($this->params);
        $brandIcons = new BrandIcon($this->params);

        return array_merge(
            array_map(static fn($icon): string => $solidIcons->prefix . $icon, $solidIcons->getAll()),
            array_map(static fn($icon): string => $regularIcons->prefix . $icon, $regularIcons->getAll()),
            array_map(static fn($icon): string => $brandIcons->prefix . $icon, $brandIcons->getAll()),
        );
    }
}
