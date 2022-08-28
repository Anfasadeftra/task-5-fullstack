<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\User::create([
            'name'	=> Str::random(20),
            'email'	=> Str::random(10) . '@homerunball.com',
            'password'	=> bcrypt('secret')
        ]);

        \App\Models\User::factory()->count(30)->create(); 
    }
}
