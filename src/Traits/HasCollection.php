<?php declare(strict_types=1);

namespace Bugo\FontAwesomeHelper\Traits;

use Bugo\FontAwesomeHelper\Enums\Type;
use Bugo\FontAwesomeHelper\Styles\BrandIcon;
use Bugo\FontAwesomeHelper\Styles\RegularIcon;
use Bugo\FontAwesomeHelper\Styles\SolidIcon;

use function array_map;
use function array_merge;

trait HasCollection
{
    public function collection(): array
    {
        $mapIcons = fn($icons, $type) => array_map(fn($icon) => $this->factory($type, $icon), $icons);

        return array_merge(
            $mapIcons((new BrandIcon())->getAll(), Type::Brand),
            $mapIcons((new RegularIcon())->getAll(), Type::Regular),
            $mapIcons((new SolidIcon())->getAll(), Type::Solid)
        );
    }
}
