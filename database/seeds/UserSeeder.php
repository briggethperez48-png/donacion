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
    public function run() {
        User::create([
            'nombre' => 'Joselyn Briggeth',
            'apPaterno' => 'Perez',
            'apMaterno' => 'Gonzalez',
            'area' => '', 
            'fechaAlta' => '2026-05-01',
            'telefono' => '5512345678',
            'status' => 'ACTIVO',
            'email' => 'briggethperez.2007@gmail.com', 
            'password' => 'Sedesa2026',
            'responsable' => '',
        ])->assignRole('SUPERADMIN');
        User::create([
            'nombre' => 'Sergio Arturo',
            'apPaterno' => 'Guerrero',
            'apMaterno' => 'Torres',
            'area' => '15', 
            'fechaAlta' => '2026-05-01', 
            'telefono' => '5512345678',
            'status' => 'ACTIVO',
            'email' => 'sergio2026@gmail.com', 
            'password' => 'Sedesa2026',
            'responsable' => '',
        ])->assignRole('SUPERADMIN');
    }
}
