<?php declare(strict_types=1);

/**
 * WithParams.php
 *
 * @package FontAwesomeHelper
 * @link https://dragomano.ru/fa-php-helper
 * @author Bugo <bugo@dragomano.ru>
 * @copyright 2024 Bugo
 * @license https://opensource.org/licenses/MIT The MIT License
 *
 * @version 0.3
 */

namespace Bugo\FontAwesomeHelper\Traits;

trait WithParams
{
    protected array $params = [
        'fixed_width' => false,
        'aria_hidden' => false,
    ];

	public function useFixedWidth(): static
	{
		$this->params['fixed_width'] = true;

		return $this;
	}

	public function useAriaHidden(): static
	{
		$this->params['aria_hidden'] = true;

		return $this;
	}
}
