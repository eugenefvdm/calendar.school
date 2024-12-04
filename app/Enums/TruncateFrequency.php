<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum TruncateFrequency: string implements HasLabel
{
    case Hourly = 'hourly';
    case Daily = 'daily';

    case Weekly = 'weekly';

    case Monthly = 'monthly';

    case EveryThreeMonths = 'every_three_months';

    case EverySixMonths = 'every_six_months';

    case Yearly = 'yearly';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Hourly => 'Hourly',
            self::Daily => 'Daily',
            self::Weekly => 'Weekly',
            self::Monthly => 'Monthly',
            self::EveryThreeMonths => 'Every Three Months',
            self::EverySixMonths => 'Every Six Months',
            self::Yearly => 'Yearly',
        };
    }
}
