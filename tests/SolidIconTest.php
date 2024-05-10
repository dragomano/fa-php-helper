<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\OldSolidIcon;
use Bugo\FontAwesomeHelper\Styles\SolidIcon;

beforeEach(function () {
	$this->icon = new SolidIcon();
	$this->oldStyleIcon = new OldSolidIcon();
});

test('get solid icon', function () {
	expect($this->icon->get('user'))->toBe('fa-solid fa-user')
		->and($this->oldStyleIcon->get('user'))->toBe('fas fa-user');
});

test('get all icons', function () {
	expect($this->icon->getAll())->toBeArray()
		->and($this->oldStyleIcon->getAll())->toBeArray();
});

test('prefixes', function () {
	expect($this->icon->prefix)->toBe('fa-solid fa-')
		->and($this->oldStyleIcon->prefix)->toBe('fas fa-');
});
