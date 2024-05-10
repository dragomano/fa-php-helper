<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Styles\OldRegularIcon;
use Bugo\FontAwesomeHelper\Styles\RegularIcon;

beforeEach(function () {
	$this->icon = new RegularIcon();
	$this->oldStyleIcon = new OldRegularIcon();
});

test('get regular icon', function () {
	expect($this->icon->get('user'))->toBe('fa-regular fa-user')
		->and($this->oldStyleIcon->get('user'))->toBe('far fa-user');
});

test('get all icons', function () {
	expect($this->icon->getAll())->toBeArray()
		->and($this->oldStyleIcon->getAll())->toBeArray();
});

test('prefixes', function () {
	expect($this->icon->prefix)->toBe('fa-regular fa-')
		->and($this->oldStyleIcon->prefix)->toBe('far fa-');
});
