<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Role: string implements HasLabel
{
    case SuperAdmin = 'super_admin';
    case Tenant = 'tenant';
    case Manager = 'manager';
    case Teacher = 'teacher';
    case Student = 'student';
    case Guardian = 'guardian';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::Tenant => 'Tenant',
            self::Admin => 'Admin',
            self::Teacher => 'Teacher',
            self::Student => 'Student',
            self::Guardian => 'Guardian',
        };
    }
}
