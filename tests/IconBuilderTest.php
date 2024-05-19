<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Enums\Icon;
use Bugo\FontAwesomeHelper\IconBuilder;

beforeEach(function () {
    $this->builderV5 = new IconBuilder(Icon::V5->solid('calendar'));
    $this->builderV6 = new IconBuilder(Icon::V6->regular('user'));
});

test('text method', function () {
    expect($this->builderV6->text())->toBe('fa-regular fa-user')
        ->and($this->builderV5->text())->toBe('fas fa-calendar');
});

test('html method', function () {
    expect($this->builderV6->html())
        ->toBe('<i class="fa-regular fa-user"></i>');
});

test('addClass method', function () {
    expect($this->builderV5->addClass('fa-spin')->text())
        ->toBe('fas fa-calendar fa-spin');
});

describe('color method', function () {
    test('tailwind classes', function () {
        expect($this->builderV5->color('text-red-500')->html())
            ->toBe('<i class="fas fa-calendar text-red-500"></i>');
    });

    test('common styles', function () {
        expect($this->builderV5->color('#000')->html())
            ->toBe('<i class="fas fa-calendar" style="color:#000"></i>');
    });
});

describe('size method', function () {
    test('correct size', function () {
        expect($this->builderV5->size('lg')->text())
            ->toBe('fas fa-calendar fa-lg');
    });

    test('incorrect size', function () {
        expect(fn() => $this->builderV5->size('10px')->text())
            ->toThrow(InvalidArgumentException::class, 'Invalid size: 10px');
    });
});

test('title method', function () {
    expect($this->builderV5->title('Calendar')->html())
        ->toBe('<i class="fas fa-calendar" title="Calendar"></i>');
});

test('fixedWidth method', function () {
    expect($this->builderV5->fixedWidth()->text())
        ->toBe('fas fa-calendar fa-fw');
});

test('ariaHidden method', function () {
    expect($this->builderV5->ariaHidden()->html())
        ->toBe('<i class="fas fa-calendar" aria-hidden="true"></i>');
});
