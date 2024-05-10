<?php declare(strict_types=1);

/**
 * IconFactoryCreator.php
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

use InvalidArgumentException;

class IconFactoryCreator
{
    public static function createFactory(string $type): IconFactory
    {
	    return match ($type) {
		    'solid' => new SolidIconFactory(),
		    'old_solid' => new OldSolidIconFactory(),
		    'regular' => new RegularIconFactory(),
		    'old_regular' => new OldRegularIconFactory(),
		    'brand' => new BrandIconFactory(),
		    'old_brand' => new OldBrandIconFactory(),
		    default => throw new InvalidArgumentException('Invalid icon type specified'),
	    };
    }
}
