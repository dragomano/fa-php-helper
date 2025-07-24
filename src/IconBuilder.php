<?php declare(strict_types=1);

namespace Bugo\FontAwesome;

use Bugo\FontAwesome\Contracts\IconParameterStrategy;
use Bugo\FontAwesome\Enums\Param;
use Bugo\FontAwesome\Enums\Size;
use Bugo\FontAwesome\Strategies\AriaHiddenParameter;
use Bugo\FontAwesome\Strategies\ColorParameter;
use Bugo\FontAwesome\Strategies\FixedWidthParameter;
use Bugo\FontAwesome\Strategies\SizeParameter;
use Bugo\FontAwesome\Strategies\TitleParameter;
use InvalidArgumentException;
use Nette\Utils\Html;

use function array_merge;
use function implode;

class IconBuilder implements \Stringable
{
    private array $params = [];

    private readonly Html $icon;

    public function __construct(string $class, array $params = [])
    {
        if (empty($class)) {
            throw new InvalidArgumentException('Icon class cannot be empty');
        }

        $this->icon = Html::el('i');
        $this->addClass($class);

        $this->params = array_merge(Param::default(), $params);
        $this->resolveParams();
    }

    public function __toString(): string
    {
        return $this->text();
    }

    public function getIcon(): Html
    {
        return $this->icon;
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
        $this->applyParameter(new ColorParameter(), $color);

        return $this;
    }

    public function size(Size|string $size): static
    {
        $this->applyParameter(new SizeParameter(), $size);

        return $this;
    }

    public function title(string $title): static
    {
        $this->applyParameter(new TitleParameter(), $title);

        return $this;
    }

    public function ariaHidden(): static
    {
        $this->applyParameter(new AriaHiddenParameter(), true);

        return $this;
    }

    public function fixedWidth(): static
    {
        $this->applyParameter(new FixedWidthParameter(), true);

        return $this;
    }

    private function applyParameter(IconParameterStrategy $strategy, mixed $value): void
    {
        $strategy->apply($this, $value);
    }

    private function resolveParams(): void
    {
        $strategies = Param::getStrategies();

        foreach ($this->params as $key => $value) {
            if (isset($strategies[$key])) {
                $this->applyParameter($strategies[$key], $value);
            }
        }
    }
}
