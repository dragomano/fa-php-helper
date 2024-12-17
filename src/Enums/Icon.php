<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Enums;

use Bugo\FontAwesome\Contracts\CasesInterface;
use Bugo\FontAwesome\Contracts\CollectionInterface;
use Bugo\FontAwesome\Contracts\RandomInterface;
use Bugo\FontAwesome\Contracts\Traits\HasCases;
use Bugo\FontAwesome\Contracts\Traits\HasCollection;
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

    public function factory(Type $type, string $identifier): IconBuilder
    {
        return $this->build($this->name, $type, $identifier);
    }

    protected function build($version, $type, $icon): IconBuilder
    {
        $validIcon = $this->getIcon($type, $icon);

        if ($validIcon === '') {
            throw new InvalidArgumentException("Invalid icon: $icon");
        }

        $baseIcon = constant(__NAMESPACE__ . "\BaseIcon::$version");

        return new IconBuilder(sprintf($baseIcon->value, $this->getSegment($type), $validIcon));
    }

    protected function getSegment(Type $type): string
    {
        return match ([$this, $type]) {
            [self::V5, Type::Brand]   => TypeId::BrandV5->value,
            [self::V5, Type::Regular] => TypeId::RegularV5->value,
            [self::V5, Type::Solid]   => TypeId::SolidV5->value,
            [self::V6, Type::Brand]   => TypeId::BrandV6->value,
            [self::V6, Type::Regular] => TypeId::RegularV6->value,
            [self::V6, Type::Solid]   => TypeId::SolidV6->value,
        };
    }

    protected function getIcon(Type $type, string $icon): string
    {
        $set = match ($type) {
            Type::Solid   => (new SolidIcon())->getAll(),
            Type::Brand   => (new BrandIcon())->getAll(),
            Type::Regular => (new RegularIcon())->getAll(),
        };

        if (($key = array_search($icon, $set, true)) !== false) {
            return $set[$key];
        }

        return '';
    }
}
