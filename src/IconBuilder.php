<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Enums\Size;
use InvalidArgumentException;
use Nette\Utils\Html;

use function array_merge;
use function implode;
use function in_array;
use function is_string;
use function method_exists;
use function preg_match;
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
        if (empty($class)) {
            throw new InvalidArgumentException('Icon class cannot be empty');
        }

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
        if (empty($color)) {
            throw new InvalidArgumentException('Color cannot be empty');
        }

        if (str_starts_with($color, 'text-')) {
            return $this->addClass($color);
        }

        if (
            preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $color)
            || preg_match('/^[a-zA-Z]+$/', $color)
        ) {
            $this->icon->style['color'] = $color;

            return $this;
        }

        throw new InvalidArgumentException('Invalid color format');
    }

    public function size(Size|string $size): static
    {
        $size = is_string($size) ? (Size::tryFrom($size) ?? Size::Default) : $size;

        return $this->addClass("fa-$size->value");
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
        $allowedParams = ['color', 'size', 'title', 'fixed-width', 'aria-hidden'];

        foreach ($this->params as $key => $value) {
            if (! in_array($key, $allowedParams)) {
                continue;
            }

            match ($key) {
                'fixed-width' => $value ? $this->fixedWidth() : null,
                'aria-hidden' => $value ? $this->ariaHidden() : null,
                default => method_exists($this, $key) ? $this->$key($value) : null,
            };
        }
    }
}
