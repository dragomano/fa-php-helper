<?php declare(strict_types=1);

namespace Bugo\FontAwesomeHelper;

use InvalidArgumentException;
use Nette\Utils\Html;

use function array_merge;
use function implode;
use function str_starts_with;
use function in_array;

class IconBuilder
{
    private array $allowedSizes = [
        '2xs', 'xs', 'sm', 'lg', 'xl', '2xl',
        '1x', '2x', '3x', '4x', '5x',
        '6x', '7x', '8x', '9x', '10x',
    ];

    private array $params = [
        'fixed-width' => false,
        'aria-hidden' => false,
    ];

    private readonly Html $icon;

    public function __construct(string $class, array $params = [])
    {
        $this->icon = Html::el('i');
        $this->icon->class[] = $class;

        $this->params = array_merge($this->params, $params);
        $this->resolveParams();
    }

    public function text(): string
    {
        return implode(' ', $this->icon->class);
    }

    public function html(): string
    {
        return $this->icon->toHtml();
    }

    public function addClass(string $class): static
    {
        $this->icon->class[] = $class;

        return $this;
    }

    public function color(string $color): static
    {
        if (str_starts_with($color, 'text-')) {
            return $this->addClass($color);
        }

        $this->icon->style['color'] = $color;

        return $this;
    }

    public function size(string $size): static
    {
        if (! in_array($size, $this->allowedSizes)) {
            throw new InvalidArgumentException("Invalid size: $size");
        }

        return $this->addClass('fa-' . $size);
    }

    public function title(string $title): static
    {
        $this->icon->title = $title;

        return $this;
    }

    public function fixedWidth(): static
    {
        return $this->addClass('fa-fw');
    }

    public function ariaHidden(): static
    {
        $this->icon->setAttribute('aria-hidden', 'true');

        return $this;
    }

    private function resolveParams(): void
    {
        foreach ($this->params as $key => $value) {
            match ($key) {
                'fixed-width' => $value ? $this->fixedWidth() : null,
                'aria-hidden' => $value ? $this->ariaHidden() : null,
                'color', 'size', 'title' => $this->$key($value),
                default => null
            };
        }
    }
}
