<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\SolidIcon;

beforeEach(function () {
	$this->icon = new SolidIcon();
	$this->oldStyleIcon = new SolidIcon([
		'deprecated_class' => true,
		'fixed_width' => true,
		'aria_hidden' => false,
	]);
});

test('get method', function () {
	expect($this->icon->get('calendar'))->toBe('fa-solid fa-calendar')
		->and($this->oldStyleIcon->get('calendar'))->toBe('fas fa-calendar fa-fw');
});

test('html method', function () {
	expect($this->icon->html('calendar'))->toBe('<i class="fa-solid fa-calendar" aria-hidden="true"></i>')
		->and($this->oldStyleIcon->html('calendar'))->toBe('<i class="fas fa-calendar fa-fw"></i>')
		->and($this->icon->html('calendar', 'some title'))->toBe('<i class="fa-solid fa-calendar" title="some title" aria-hidden="true"></i>');
});

test('size method', function () {
	expect($this->oldStyleIcon->size('lg')->get('house'))->toBe('fas fa-house fa-fw fa-lg');
});

test('color method', function () {
	expect($this->oldStyleIcon->color('#000')->html('heart'))->toBe('<i class="fas fa-heart fa-fw" style="color: #000"></i>');
});

test('extra method', function () {
	expect($this->oldStyleIcon->extra('fa-spin')->get('heart'))->toBe('fas fa-heart fa-spin fa-fw');
});

test('random method', function () {
	expect($this->icon->random())->toBeString()
		->and($this->icon->random())->not->toBe($this->icon->random());
});
