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
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'oooooo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ])->assignRole('SuperAdmin');
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'ooo1oo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ])->assignRole('Admin');
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'oooo3o@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ])->assignRole('Editor');
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'ooo12o@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ])->assignRole('Reader');
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => '24doooo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ])->assignRole('Inactivo');
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'oohhdoo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => '1334ooo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);

        User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'ooasasdoo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'oo1341oo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'o23oo3o@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'o3o12o@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => '243oooo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => 'odfghdoo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);
         User::create([
            'nombre' => 'AAA',
            'apPaterno' => 'EEE',
            'apMaterno' => 'IIIIIIIII',
            'area' => '14', 
            'fechaAlta' => '2026-05-01', //Fecha de Alta en la página 
            'telefono' => '5512345678',
            'status' => 'INACTIVO', //Tipo Logico: Activado/Desactivado
            'email' => '133424oo@gmail.com', 
            'password' => 'fuentess',
            'responsable' => 'alguien', //Quien metió al usuario
        ]);

    }
}
