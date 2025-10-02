<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Enums;

use Bugo\FontAwesome\Contracts\CasesInterface;
use Bugo\FontAwesome\Contracts\CollectionInterface;
use Bugo\FontAwesome\Contracts\RandomInterface;
use Bugo\FontAwesome\Contracts\Traits\HasCases;
use Bugo\FontAwesome\Contracts\Traits\HasCollection;
use Bugo\FontAwesome\Contracts\Traits\HasNewBehavior;
use Bugo\FontAwesome\Contracts\Traits\HasRandom;
use Bugo\FontAwesome\IconBuilder;
use Bugo\FontAwesome\Styles\BrandIcon;
use Bugo\FontAwesome\Styles\RegularIcon;
use Bugo\FontAwesome\Styles\SolidIcon;
use InvalidArgumentException;

use function array_search;
use function constant;
use function sprintf;

enum Icon: string implements CasesInterface, CollectionInterface, RandomInterface
{
    use HasCases, HasCollection, HasRandom;

    case V5 = '5';
    case V6 = '6';
    case V7 = '7';

    public function factory(Style $style, string $identifier): IconBuilder
    {
        return $this->build($this->name, $style, $identifier);
    }

    protected function build(string $version, Style $style, string $icon): IconBuilder
    {
        $version = $this->normalizeVersion($version);
        $validIcon = $this->validateIcon($style, $icon);
        $iconClass = $this->buildIconClass($version, $style, $validIcon);

        return $this->createIconBuilder($iconClass);
    }

    private function normalizeVersion(string $version): string
    {
        return $version === self::V7->name ? self::V6->name : $version;
    }

    private function validateIcon(Style $style, string $icon): string
    {
        $validIcon = $this->getIcon($style, $icon);

        if ($validIcon === '') {
            throw new InvalidArgumentException("Icon '$icon' not found in $style->name collection");
        }

        return $validIcon;
    }

    private function buildIconClass(string $version, Style $style, string $validIcon): string
    {
        $template = constant(__NAMESPACE__ . "\Template::$version");

        return sprintf($template->value, $this->getSegment($style), $validIcon);
    }

    private function createIconBuilder(string $iconClass): IconBuilder
    {
        if ($this->value === self::V7->value) {
            return new class($iconClass) extends IconBuilder {
                use HasNewBehavior;
            };
        }

        return new IconBuilder($iconClass);
    }

    private function getSegment(Style $style): string
    {
        return match ([$this, $style]) {
            [self::V5, Style::Brands] => Segment::BrandV5->value,
            [self::V5, Style::Regular] => Segment::RegularV5->value,
            [self::V5, Style::Solid] => Segment::SolidV5->value,
            [self::V6, Style::Brands], [self::V7, Style::Brands] => Segment::BrandV6->value,
            [self::V6, Style::Regular], [self::V7, Style::Regular] => Segment::RegularV6->value,
            [self::V6, Style::Solid], [self::V7, Style::Solid] => Segment::SolidV6->value,
        };
    }

    private function getIcon(Style $style, string $icon): string
    {
        $set = match ($style) {
            Style::Brands  => (new BrandIcon())->getAll((int) $this->value),
            Style::Regular => (new RegularIcon())->getAll((int) $this->value),
            Style::Solid   => (new SolidIcon())->getAll((int) $this->value),
        };

        if (($key = array_search($icon, $set, true)) !== false) {
            return $set[$key];
        }

        return '';
    }
}
