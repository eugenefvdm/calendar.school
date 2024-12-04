<?php

namespace App\Models;

use App\Traits\HasTenantRelationship;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasTenantRelationship;

    protected $fillable = [
        'tenant_id',
        'key',
        'value',
    ];

    public static function get(string $key, $tenantId)
    {
        if (! $tenantId) {
            $tenantId = Filament::getTenant()->id;
        }

        $setting = static::where('tenant_id', $tenantId)
            ->where('key', $key)->first();

        return $setting?->value;
    }
}
