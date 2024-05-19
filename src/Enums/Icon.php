<?php declare(strict_types=1);

namespace Bugo\FontAwesomeHelper\Enums;

use Bugo\FontAwesomeHelper\Interfaces\CasesAwareInterface;
use Bugo\FontAwesomeHelper\Interfaces\CollectionAwareInterface;
use Bugo\FontAwesomeHelper\Interfaces\RandomAwareInterface;
use Bugo\FontAwesomeHelper\Styles\BrandIcon;
use Bugo\FontAwesomeHelper\Styles\RegularIcon;
use Bugo\FontAwesomeHelper\Styles\SolidIcon;
use Bugo\FontAwesomeHelper\Traits\HasCases;
use Bugo\FontAwesomeHelper\Traits\HasCollection;
use Bugo\FontAwesomeHelper\Traits\HasRandom;

use function sprintf;
use function array_search;

enum Icon: string implements CasesAwareInterface, CollectionAwareInterface, RandomAwareInterface
{
    use HasCases, HasCollection, HasRandom;

    case V5 = '5';
    case V6 = '6';

    public function factory(Type $type, string $identifier): string
    {
        return $this->build($this->name, $type, $identifier);
    }

    protected function build($version, $type, $icon): string
    {
        $validIcon = $this->getIcon($type, $icon);
        $baseIcon = constant(__NAMESPACE__ . "\BaseIcon::$version");

        return $validIcon ? sprintf($baseIcon->value, $this->getSegment($type), $validIcon) : '';
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
