<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        
        $this->call(UserSeeder::class); //Para pruebas
        
        $this->call(AreasSeeder::class);
        $this->call(OrganosSeeder::class);
        $this->call(alcaldiaSeeder::class);
    }
}
