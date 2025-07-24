<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Contracts\Traits;

use Bugo\FontAwesome\Enums\Style;
use Bugo\FontAwesome\Styles\BrandIcon;
use Bugo\FontAwesome\Styles\RegularIcon;
use Bugo\FontAwesome\Styles\SolidIcon;

use function array_map;
use function array_merge;

trait HasCollection
{
    public function collection(): array
    {
        return array_merge(
            $this->brandOnly(),
            $this->regularOnly(),
            $this->solidOnly(),
        );
    }

    public function brandOnly(): array
    {
        return $this->getMappedIcons(BrandIcon::class, Style::Brand);
    }

    public function regularOnly(): array
    {
        return $this->getMappedIcons(RegularIcon::class, Style::Regular);
    }

    public function solidOnly(): array
    {
        return $this->getMappedIcons(SolidIcon::class, Style::Solid);
    }

    private function getMappedIcons(string $iconClass, Style $style): array
    {
        $icons = (new $iconClass())->getAll();

        return array_map(fn($icon) => (string) $this->factory($style, $icon), $icons);
    }
}
