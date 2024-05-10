<?php declare(strict_types=1);

/**
 * AbstractIcon.php
 *
 * @package FontAwesomeHelper
 * @link https://dragomano.ru/fa-php-helper
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/licenses/MIT The MIT License
 *
 * @version 0.3
 */

namespace Bugo\FontAwesomeHelper\Styles;

use Bugo\FontAwesomeHelper\IconInterface;
use Bugo\FontAwesomeHelper\Traits\WithParams;
use Bugo\FontAwesomeHelper\Traits\WithRandomIcon;

abstract class AbstractIcon implements IconInterface
{
    use WithParams, WithRandomIcon;

    protected string $prefix;

    protected string $suffix = '';

    protected string $extra = '';

    protected string $color = '';

    protected array $sizes = [
        '2xs',
        'xs',
        'sm',
        'lg',
        'xl',
        '2xl',
    ];

    public function get(string $icon): string
    {
        return $this->prefix . $icon . $this->extra . $this->getSuffix();
    }

    public function html(string $icon, string $title = ''): string
    {
        $colorStyle = $this->getColorStyle();
        $titleAttribute = $this->getTitleAttribute($title);
        $ariaHidden = $this->getAriaHiddenAttribute();

        return '<i class="' . $this->get($icon) . '"' . $colorStyle . $titleAttribute . $ariaHidden . '></i>';
    }

    public function size(string $size): self
    {
        if (isset(array_flip($this->sizes)[$size])) {
            $this->suffix .= ' fa-' . $size;
        }

        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function extra(string $extra): self
    {
        $this->extra .= ' ' . $extra;

        return $this;
    }

    private function getColorStyle(): string
    {
        return $this->color ? ' style="color: ' . $this->color . '"' : '';
    }

    private function getTitleAttribute(string $title): string
    {
        return $title ? ' title="' . $title . '"' : '';
    }

    private function getAriaHiddenAttribute(): string
    {
        return $this->params['aria_hidden'] ? ' aria-hidden="true"' : '';
    }

	private function getSuffix(): string
	{
		return $this->params['fixed_width'] ? $this->suffix . ' fa-fw' : $this->suffix;
	}
}
