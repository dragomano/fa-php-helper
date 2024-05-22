<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts\Traits;

use Bugo\FontAwesome\Enums\Type;
use Bugo\FontAwesome\Styles\BrandIcon;
use Bugo\FontAwesome\Styles\RegularIcon;
use Bugo\FontAwesome\Styles\SolidIcon;

use function array_map;
use function array_merge;

trait HasCollection
{
    public function collection(): array
    {
        $mapIcons = fn($icons, $type) => array_map(fn($icon) => (string) $this->factory($type, $icon), $icons);

        return array_merge(
            $mapIcons((new BrandIcon())->getAll(), Type::Brand),
            $mapIcons((new RegularIcon())->getAll(), Type::Regular),
            $mapIcons((new SolidIcon())->getAll(), Type::Solid)
        );
    }
}
