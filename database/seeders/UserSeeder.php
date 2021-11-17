<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        User::factory()->count(1)->create([
            'email' => 'admin@lt.lt',
            'admin' => true,
        ]);
        //User
        User::factory()->count(1)->create();

    }
}
