<?php declare(strict_types=1);

namespace Bugo\FontAwesome\Enums;

enum Template: string
{
    case V5 = 'fa%s fa-%s';
    case V6 = 'fa-%s fa-%s';
}
