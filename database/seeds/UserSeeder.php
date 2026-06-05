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
            'nombre' => 'Joselyn Briggeth',
            'apPaterno' => 'Perez',
            'apMaterno' => 'Gonzalez',
            'area' => 'COMISIÓN DE BIOÉTICA', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'ACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'briggethperez.2007@gmail.com', 
            'password' => 'Sedesa2026',
            'responsable' => '', //Quien metió al usuario
        ])->assignRole('SuperAdmin');
         User::create([
            'nombre' => 'Sergio Arturo',
            'apPaterno' => 'Guerrero',
            'apMaterno' => 'Torres',
            'area' => 'SECRETARIA PARTICULAR DE LA SECRETARIA DE SALUD PÚBLICA DE LA CIUDAD DE MÉXICO', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'ACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'sergio2026@gmail.com', 
            'password' => 'Sedesa2026',
            'responsable' => '', //Quien metió al usuario
        ])->assignRole('SuperAdmin');
    }
}
