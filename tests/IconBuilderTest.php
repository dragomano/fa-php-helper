<?php declare(strict_types=1);

use Bugo\FontAwesome\Enums\Icon;
use Bugo\FontAwesome\Enums\Size;
use Bugo\FontAwesome\IconBuilder;

beforeEach(function () {
    $this->calendarIcon = new IconBuilder(Icon::V5->solid('calendar')->text());
    $this->userIcon = new IconBuilder(Icon::V6->regular('user')->text());
    $this->catIcon = new IconBuilder(Icon::V5->solid('cat')->text(), [
        'size'  => '7x',
        'color' => '#fff',
        'title' => 'Tom',
    ]);
});

it('throws exception when empty class provided', function () {
    expect(fn() => new IconBuilder(''))
        ->toThrow(
            InvalidArgumentException::class,
            'Icon class cannot be empty'
        );
});

test('text method', function () {
    expect($this->userIcon->text())->toBe('fa-regular fa-user')
        ->and($this->calendarIcon->text())->toBe('fas fa-calendar');
});

test('html method', function () {
    expect($this->userIcon->html())
        ->toBe('<i class="fa-regular fa-user"></i>');
});

test('addClass method', function () {
    expect($this->calendarIcon->addClass('fa-spin')->text())
        ->toBe('fas fa-calendar fa-spin');
});

describe('color method', function () {
    it('accepts valid hex color', function () {
        expect($this->calendarIcon->color('#ff0000')->html())
            ->toBe('<i class="fas fa-calendar" style="color:#ff0000"></i>');
    });

    it('accepts short hex color', function () {
        expect($this->calendarIcon->color('#f00')->html())
            ->toBe('<i class="fas fa-calendar" style="color:#f00"></i>');
    });

    it('accepts CSS color name', function () {
        expect($this->calendarIcon->color('red')->html())
            ->toBe('<i class="fas fa-calendar" style="color:red"></i>');
    });

    it('accepts Bootstrap text color classes', function () {
        expect($this->calendarIcon->color('text-primary')->text())
            ->toBe('fas fa-calendar text-primary');
    });

    it('accepts Tailwind text color classes', function () {
        expect($this->calendarIcon->color('text-red-500')->text())
            ->toBe('fas fa-calendar text-red-500');
    });

    it('throws exception for invalid color format', function () {
        expect(fn() => $this->calendarIcon->color('not-a-color!'))
            ->toThrow(
                InvalidArgumentException::class,
                'Use hex (#RRGGBB), named color (red) or Tailwind CSS class (text-red-500).'
            );
    });
});

describe('size method', function () {
    it('checks Size enum param', function () {
        expect($this->calendarIcon->size(Size::XS)->text())
            ->toBe('fas fa-calendar fa-xs');
    });

    it('checks string param', function () {
        expect($this->calendarIcon->size('lg')->text())
            ->toBe('fas fa-calendar fa-lg');
    });

    it('checks unknown param', function () {
        expect($this->calendarIcon->size('10px')->text())
            ->toBe('fas fa-calendar fa-' . Size::Default->value);
    });

    it('checks icon with specified size', function () {
        expect($this->catIcon->text())->toBe('fas fa-cat fa-7x');
    });
});

describe('title method', function () {
    it('checks string param', function () {
        expect($this->calendarIcon->title('Calendar')->html())
            ->toBe('<i class="fas fa-calendar" title="Calendar"></i>');
    });

    it('checks icon with specified title', function () {
        expect($this->catIcon->html())
            ->toBe('<i class="fas fa-cat fa-7x" style="color:#fff" title="Tom"></i>');
    });
});

test('ariaHidden method', function () {
    expect($this->calendarIcon->ariaHidden()->html())
        ->toBe('<i class="fas fa-calendar" aria-hidden="true"></i>');
});

describe('fixedWidth method', function () {
    test('default behavior (v5/v6)', function () {
        $icon = Icon::V6->solid('cat')->fixedWidth();

        expect($icon->text())->toContain('fa-fw');
    });

    test('drop fa-fw class in V7', function () {
        $icon = Icon::V7->solid('cat')->fixedWidth();

        expect($icon->text())->toBe(Icon::V7->solid('cat')->text());
    });
});

describe('resolveParams method', function () {
    it('applies color from params', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['color' => '#ff0000']);

        expect($icon->html())
            ->toContain('style="color:#ff0000"');
    });

    it('applies size from params', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['size' => Size::Large]);

        expect($icon->text())
            ->toContain('fa-lg');
    });

    it('applies title from params', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['title' => 'User Icon']);

        expect($icon->html())
            ->toContain('title="User Icon"');
    });

    it('applies fixed width from params', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['fixed-width' => true]);

        expect($icon->text())
            ->toContain('fa-fw');
    });

    it('applies aria-hidden from params', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['aria-hidden' => true]);

        expect($icon->html())
            ->toContain('aria-hidden="true"');
    });

    it('ignores fixed-width when false', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['fixed-width' => false]);

        expect($icon->text())
            ->not->toContain('fa-fw');
    });

    it('ignores aria-hidden when false', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['aria-hidden' => false]);

        expect($icon->html())
            ->not->toContain('aria-hidden');
    });

    it('ignores unknown params', function () {
        $icon = new IconBuilder(Icon::V6->regular('user')->text(), ['unknown-param' => 'value']);

        expect($icon->text())->toBe('fa-regular fa-user');
    });

    it('applies multiple params together', function () {
        $icon = new IconBuilder('fas fa-user', [
            'color'       => 'red',
            'size'        => Size::Large,
            'fixed-width' => true,
            'aria-hidden' => true,
            'title'       => 'User Icon',
        ]);

        expect($icon->html())
            ->toContain('style="color:red"')
            ->toContain('fa-lg')
            ->toContain('fa-fw')
            ->toContain('aria-hidden="true"')
            ->toContain('title="User Icon"');
    });
});
