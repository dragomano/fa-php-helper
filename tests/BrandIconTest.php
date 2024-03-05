<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\BrandIcon;

beforeEach(function () {
	$this->icon = new BrandIcon();
	$this->oldStyleIcon = new BrandIcon(['deprecated_class' => true]);
});

test('get brand icon', function () {
	expect($this->icon->get('apple'))->toBe('fa-brands fa-apple')
		->and($this->oldStyleIcon->get('facebook'))->toBe('fab fa-facebook');
});

test('get all icons', function () {
	expect($this->icon->getAll())->toBeArray();
});
