<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Factories\IconFactoryCreator;

beforeEach(function () {
	$this->iconFactoryCreator = new IconFactoryCreator();
	$this->iconFactory = $this->iconFactoryCreator::createFactory('solid');
	$this->icon = $this->iconFactory->createIcon();
	$this->oldIconFactory = $this->iconFactoryCreator::createFactory('old_solid');
	$this->oldStyleIcon = $this->oldIconFactory->createIcon();
});

test('get method', function () {
	expect($this->icon->get('calendar'))->toBe('fa-solid fa-calendar')
		->and($this->oldStyleIcon->get('calendar'))->toBe('fas fa-calendar');
});

test('html method', function () {
	expect($this->icon->html('calendar'))->toBe('<i class="fa-solid fa-calendar"></i>')
		->and($this->oldStyleIcon->html('calendar'))->toBe('<i class="fas fa-calendar"></i>')
		->and($this->icon->html('calendar', 'some title'))->toBe('<i class="fa-solid fa-calendar" title="some title"></i>');
});

test('size method', function () {
	expect($this->oldStyleIcon->size('lg')->get('house'))->toBe('fas fa-house fa-lg');
});

test('color method', function () {
	expect($this->oldStyleIcon->color('#000')->html('heart'))->toBe('<i class="fas fa-heart" style="color: #000"></i>');
});

test('extra method', function () {
	expect($this->oldStyleIcon->extra('fa-spin')->get('heart'))->toBe('fas fa-heart fa-spin');
});

test('random method', function () {
	expect($this->icon->random())->toBeString()
		->and($this->icon->random())->not->toBe($this->icon->random());
});

test('useFixedWidth method', function () {
	expect($this->icon->get('apple'))->toBe('fa-solid fa-apple')
		->and($this->oldStyleIcon->useFixedWidth()->get('apple'))->toBe('fas fa-apple fa-fw');
});

test('useAriaHidden method', function () {
	expect($this->oldStyleIcon->html('apple'))->toBe('<i class="fas fa-apple"></i>')
		->and($this->oldStyleIcon->useAriaHidden()->html('apple'))->toBe('<i class="fas fa-apple" aria-hidden="true"></i>');
});
