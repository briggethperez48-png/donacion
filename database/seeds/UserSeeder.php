<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Hola mundo',
            'email' => 'ayudadios@gmail.com',
            'password' => bcrypt('hola')
        ])->assignRole('Reader');

    }
}
