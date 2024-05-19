<?php declare(strict_types=1);

namespace Bugo\FontAwesomeHelper\Enums;

enum BaseIcon: string
{
    case V5 = 'fa%s fa-%s';
    case V6 = 'fa-%s fa-%s';
}
