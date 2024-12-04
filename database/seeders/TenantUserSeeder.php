<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Eugene
        DB::table('tenant_user')->insert([
            'user_id' => 1,
            'tenant_id' => 1,
        ]);

        DB::table('tenant_user')->insert([
            'user_id' => 2,
            'tenant_id' => 1,
        ]);

        DB::table('tenant_user')->insert([
            'user_id' => 3,
            'tenant_id' => 1,
        ]);
    }
}
