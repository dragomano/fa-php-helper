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
 * @version 0.1
 */

namespace Bugo\FontAwesomeHelper;

use Exception;

abstract class AbstractIcon implements IconStyle
{
    protected string $oldPrefix;

    protected string $prefix;

    protected string $suffix = '';

    protected string $extra = '';

    protected string $color = '';

    protected array $params = [
        'deprecated_class' => false,
        'fixed_width' => false,
        'aria_hidden' => true,
    ];

    protected array $sizes = [
        '2xs',
        'xs',
        'sm',
        'lg',
        'xl',
        '2xl',
    ];

    public function __construct(array $params = [])
    {
        $this->params = array_merge($this->params, $params);

        if ($this->params['deprecated_class']) {
            $this->prefix = $this->oldPrefix;
        }

        if ($this->params['fixed_width']) {
            $this->suffix .= ' fa-fw';
        }
    }

    public function get(string $icon): string
    {
        return $this->prefix . $icon . $this->extra . $this->suffix;
    }

    public function html(string $icon, string $title = ''): string
    {
        $color = $this->color ? ' style="color: ' . $this->color . '"' : '';

        $title = $title ? ' title="' . $title . '"' : '';

        $aria = $this->params['aria_hidden'] ? ' aria-hidden="true"' : '';

        return '<i class="' . $this->get($icon) . '"' . $color . $title . $aria . '></i>';
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

	/**
	 * @throws Exception
	 */
	public function random(): string
    {
        $icons = $this->getAll();
	    $index = random_int(0, count($icons) - 1);

        return $this->get($icons[$index]);
    }
}
