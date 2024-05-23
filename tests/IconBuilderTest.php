<?php declare(strict_types=1);

use Bugo\FontAwesome\Enums\Icon;
use Bugo\FontAwesome\Enums\Size;
use Bugo\FontAwesome\IconBuilder;

beforeEach(function () {
    $this->iconV5 = new IconBuilder(Icon::V5->solid('calendar')->text());
    $this->iconV6 = new IconBuilder(Icon::V6->regular('user')->text());
});

test('text method', function () {
    expect($this->iconV6->text())->toBe('fa-regular fa-user')
        ->and($this->iconV5->text())->toBe('fas fa-calendar');
});

test('html method', function () {
    expect($this->iconV6->html())
        ->toBe('<i class="fa-regular fa-user"></i>');
});

test('addClass method', function () {
    expect($this->iconV5->addClass('fa-spin')->text())
        ->toBe('fas fa-calendar fa-spin');
});

describe('color method', function () {
    test('tailwind classes', function () {
        expect($this->iconV5->color('text-red-500')->html())
            ->toBe('<i class="fas fa-calendar text-red-500"></i>');
    });

    test('common styles', function () {
        expect($this->iconV5->color('#000')->html())
            ->toBe('<i class="fas fa-calendar" style="color:#000"></i>');
    });
});

describe('size method', function () {
    it('checks Size enum param', function () {
        expect($this->iconV5->size(Size::XS)->text())
            ->toBe('fas fa-calendar fa-xs');
    });

    it('checks string param', function () {
        expect($this->iconV5->size('lg')->text())
            ->toBe('fas fa-calendar fa-lg');
    });

    it('checks unknown param', function () {
        expect($this->iconV5->size('10px')->text())
            ->toBe('fas fa-calendar fa-' . Size::Default->value);
    });
});

test('title method', function () {
    expect($this->iconV5->title('Calendar')->html())
        ->toBe('<i class="fas fa-calendar" title="Calendar"></i>');
});

test('fixedWidth method', function () {
    expect($this->iconV5->fixedWidth()->text())
        ->toBe('fas fa-calendar fa-fw');
});

test('ariaHidden method', function () {
    expect($this->iconV5->ariaHidden()->html())
        ->toBe('<i class="fas fa-calendar" aria-hidden="true"></i>');
});
