<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\RegularIcon;

beforeEach(function () {
	$this->icon = new RegularIcon();
	$this->oldStyleIcon = new RegularIcon(['deprecated_class' => true]);
});

test('get regular icon', function () {
	expect($this->icon->get('user'))->toBe('fa-regular fa-user')
		->and($this->oldStyleIcon->get('user'))->toBe('far fa-user');
});

test('get all icons', function () {
	expect($this->icon->getAll())->toBeArray();
});
