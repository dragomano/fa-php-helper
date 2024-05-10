<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\BrandIcon;
use Bugo\FontAwesomeHelper\Styles\OldBrandIcon;

beforeEach(function () {
	$this->icon = new BrandIcon();
	$this->oldStyleIcon = new OldBrandIcon();
});

test('get brand icon', function () {
	expect($this->icon->get('apple'))->toBe('fa-brands fa-apple')
		->and($this->oldStyleIcon->get('facebook'))->toBe('fab fa-facebook');
});

test('get all icons', function () {
	expect($this->icon->getAll())->toBeArray()
		->and($this->oldStyleIcon->getAll())->toBeArray();
});

test('prefixes', function () {
	expect($this->icon->prefix)->toBe('fa-brands fa-')
		->and($this->oldStyleIcon->prefix)->toBe('fab fa-');
});
