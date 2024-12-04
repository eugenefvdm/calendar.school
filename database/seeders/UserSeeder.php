<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => 'Eugene van der Merwe',
            'email' => 'eugene@vander.host',
            'password' => '$2y$10$iOyxzNOs38o4zlAcS2rVQ.OMPkZ/HMyU.o1RxlRWZRsCkm5ynDeVW',
        ])->assignRole([Role::SuperAdmin, Role::Manager]);

        User::create([
            'name' => 'Nicky Jansen',
            'email' => 'nicky@themusichq.co.za',
            'password' => '$2y$10$iOyxzNOs38o4zlAcS2rVQ.OMPkZ/HMyU.o1RxlRWZRsCkm5ynDeVW',
        ])->assignRole([Role::Manager]);

        User::create([
            'name' => 'Elizabeth',
            'email' => 'elizabeth@themusichq.co.za',
            'password' => '$2y$10$iOyxzNOs38o4zlAcS2rVQ.OMPkZ/HMyU.o1RxlRWZRsCkm5ynDeVW',
        ])->assignRole([Role::Manager]);
    }
}
