<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Strategies;

use Bugo\FontAwesome\Contracts\IconParameterStrategy;
use Bugo\FontAwesome\IconBuilder;
use InvalidArgumentException;

use function preg_match;
use function str_starts_with;

class ColorParameter implements IconParameterStrategy
{
    public function apply(IconBuilder $iconBuilder, mixed $value): void
    {
        $value = (string) $value;

        $iconBuilder->getIcon()->style['color'] = match (true) {
            $this->isHexColor($value) || $this->isNamedColor($value) => $value,
            $this->isTailwindColorClass($value) => $iconBuilder->addClass($value),
            default => throw new InvalidArgumentException(
                "Invalid color format. Use hex (#RRGGBB), named color (red) or Tailwind CSS class (text-red-500)."
            ),
        };
    }

    private function isHexColor(string $color): bool
    {
        return (bool) preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color);
    }

    private function isNamedColor(string $color): bool
    {
        return (bool) preg_match('/^[a-zA-Z]+$/', $color);
    }

    private function isTailwindColorClass(string $color): bool
    {
        return str_starts_with($color, 'text-');
    }
}
