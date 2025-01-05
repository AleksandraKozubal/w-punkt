<?php

declare(strict_types=1);

namespace App\Enums;

enum WeaponType: string
{
    case Rifle = "karabin";
    case Pistol = "pistolet";
    case Other = "inne";
}
