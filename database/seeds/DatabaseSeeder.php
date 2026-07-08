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
        
        $this->call(UserSeeder::class);
        
        $this->call(InstitucionesSeeder::class);
        $this->call(UnidadesSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(OrganosSeeder::class);
        $this->call(alcaldiaSeeder::class);

        $this->call(CatalogoSeeder::class);
        $this->call(CatCalleSeeder::class);
        $this->call(CatColoniaSeeder::class);
        $this->call(CatDelegacionSeeder::class);
        $this->call(CatModuloSeeder::class);
        $this->call(HistUsuariosSeeder::class);
        $this->call(LineaCapturaSeeder::class);
    }
}
