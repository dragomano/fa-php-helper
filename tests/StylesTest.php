<?php declare(strict_types=1);

use Bugo\FontAwesome\Styles\BrandIcon;
use Bugo\FontAwesome\Styles\RegularIcon;
use Bugo\FontAwesome\Styles\SolidIcon;

describe('getAll method', function () {
    dataset('icon_styles_and_versions', [
        [BrandIcon::class, 5, 'github', '42-group', 'cash-app'],
        [BrandIcon::class, 6, 'github', '42-group', 'cash-app'],
        [BrandIcon::class, 7, 'github', '42-group', 'cash-app'],
        [RegularIcon::class, 5, 'user', 'chess-bishop', 'alarm-clock'],
        [RegularIcon::class, 6, 'user', 'chess-bishop', 'alarm-clock'],
        [RegularIcon::class, 7, 'user', 'chess-bishop', 'alarm-clock'],
        [SolidIcon::class, 5, 'user', '0', 'alarm-clock'],
        [SolidIcon::class, 6, 'user', '0', 'alarm-clock'],
        [SolidIcon::class, 7, 'user', '0', 'alarm-clock'],
    ]);

    test('returns correct icons for version', function ($styleClass, $version, $containV5, $containV6, $containV7) {
        $icons = (new $styleClass())->getAll($version);
        $reflection = new ReflectionClass($styleClass);
        $v5Count = count($reflection->getConstant('V5'));
        $v6Count = count($reflection->getConstant('ADDED_IN_V6'));
        $v7Count = count($reflection->getConstant('ADDED_IN_V7'));

        $expectedCount = match ($version) {
            5 => $v5Count,
            6 => $v5Count + $v6Count,
            7 => $v5Count + $v6Count + $v7Count,
        };

        expect($icons)->toHaveCount($expectedCount)
            ->and($icons)->toContain($containV5);

        if ($version >= 6) {
            expect($icons)->toContain($containV6);
        } else {
            expect($icons)->not->toContain($containV6);
        }

        if ($version >= 7) {
            expect($icons)->toContain($containV7);
        } else {
            expect($icons)->not->toContain($containV7);
        }
    })->with('icon_styles_and_versions');
});
