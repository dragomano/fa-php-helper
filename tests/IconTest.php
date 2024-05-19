<?php declare(strict_types=1);

use Bugo\FontAwesomeHelper\Enums\Icon;

test('brand method', function () {
    expect(Icon::V5->brand('42-group'))->toBe('fab fa-42-group')
        ->and(Icon::V6->brand('windows'))->toBe('fa-brands fa-windows');
});

test('regular method', function () {
    expect(Icon::V5->regular('user'))->toBe('far fa-user')
        ->and(Icon::V6->regular('clock'))->toBe('fa-regular fa-clock');
});

test('solid method', function () {
    expect(Icon::V5->solid('user'))->toBe('fas fa-user')
        ->and(Icon::V6->solid('folder'))->toBe('fa-solid fa-folder');
});

test('unkhown icon', function () {
    expect(Icon::V5->brand('foo'))->toBe('')
        ->and(Icon::V6->brand('bar'))->toBe('');
});

test('collection method', function () {
    expect(Icon::V5->collection())->toBeArray()
        ->and(Icon::V6->collection())->toContain('fa-solid fa-user');
});

test('random method', function () {
    expect(Icon::V5->random())->toBeString()
        ->and(Icon::V6->random())->not->toBe(Icon::V6->random());
});
