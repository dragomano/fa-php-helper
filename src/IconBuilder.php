<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Enums\Size;
use Nette\Utils\Html;

use function array_merge;
use function implode;
use function str_starts_with;

class IconBuilder implements \Stringable
{
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

    public function __toString(): string
    {
        return $this->text();
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

    public function size(Size|string $size): static
    {
        $size = is_string($size) ? (Size::tryFrom($size) ?? Size::Default) : $size;

        return $this->addClass('fa-' . $size->value);
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
