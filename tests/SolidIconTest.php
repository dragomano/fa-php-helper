<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\SolidIcon;

beforeEach(function () {
	$this->icon = new SolidIcon();
	$this->oldStyleIcon = new SolidIcon(['deprecated_class' => true]);
});

test('get solid icon', function () {
	expect($this->icon->get('user'))->toBe('fa-solid fa-user')
		->and($this->oldStyleIcon->get('user'))->toBe('fas fa-user');
});

test('get all icons', function () {
	expect($this->icon->getAll())->toBeArray();
});
