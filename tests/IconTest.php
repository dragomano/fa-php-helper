<?php declare(strict_types=1);

use Bugo\FontAwesome\Enums\Icon;

test('brand method', function () {
    expect(Icon::V5->brand('paypal')->text())->toBe('fab fa-paypal')
        ->and(Icon::V6->brand('windows')->text())->toBe('fa-brands fa-windows');
});

test('regular method', function () {
    expect(Icon::V5->regular('user')->text())->toBe('far fa-user')
        ->and(Icon::V6->regular('clock')->text())->toBe('fa-regular fa-clock');
});

test('solid method', function () {
    expect(Icon::V5->solid('user')->text())->toBe('fas fa-user')
        ->and(Icon::V6->solid('folder')->text())->toBe('fa-solid fa-folder');
});

test('invalid icon', function () {
    expect(fn() => Icon::V5->brand('foo'))
        ->toThrow(InvalidArgumentException::class, 'Invalid icon: foo');
});

test('collection method', function () {
    expect(Icon::V5->collection())->toBeArray()
        ->and(Icon::V6->collection())->toContain('fa-solid fa-user');
});

test('random method', function () {
    expect(Icon::V5->random())->toBeString()
        ->and(Icon::V6->random())->not->toBe(Icon::V6->random());
});
