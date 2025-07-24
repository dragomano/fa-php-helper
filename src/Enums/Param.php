<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Enums;

use Bugo\FontAwesome\Strategies\AriaHiddenParameter;
use Bugo\FontAwesome\Strategies\ColorParameter;
use Bugo\FontAwesome\Strategies\FixedWidthParameter;
use Bugo\FontAwesome\Strategies\SizeParameter;
use Bugo\FontAwesome\Strategies\TitleParameter;

enum Param: string
{
    case COLOR = 'color';
    case SIZE = 'size';
    case TITLE = 'title';
    case FIXED_WIDTH = 'fixed-width';
    case ARIA_HIDDEN = 'aria-hidden';

    public static function default(): array
    {
        return [
            self::FIXED_WIDTH->value => false,
            self::ARIA_HIDDEN->value => false,
        ];
    }

    public static function getStrategies(): array
    {
        return [
            self::COLOR->value => new ColorParameter(),
            self::SIZE->value => new SizeParameter(),
            self::TITLE->value => new TitleParameter(),
            self::FIXED_WIDTH->value => new FixedWidthParameter(),
            self::ARIA_HIDDEN->value => new AriaHiddenParameter(),
        ];
    }
}
