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
            'nombre' => 'Miguel angel',
            'apPaterno' => 'Vazquez',
            'apMaterno' => '',
            'login' => 'mike',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => '6YOXvqyTdJ@salud.cdmx.gob.mx', 
            'password' => '$2y$10$Fz1N8ioZ/6ojwrIfpL.qXe2GwRlR7PgZSrqtXphFlITuKYNqJany.',
            'responsable' => '',
        ])->assignRole('Administrador');
        User::create([
            'nombre' => 'noe',
            'apPaterno' => 'salgado',
            'apMaterno' => '',
            'login' => 'noe',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => 'ssdfnoe@salud.cdmx.gob.mx', 
            'password' => '$2y$10$ADl4d4nDv.RczgdvlvPY4.MpmaHrQLX3KKVyPEzcX89TyK7uOGme2',
            'responsable' => '',
        ])->assignRole('Administrador');
        User::create([
            'nombre' => 'Alejandro',
            'apPaterno' => 'de la Torre',
            'apMaterno' => '',
            'login' => 'alex',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => 'adelatirre@salud.cdmx.gob.mx', 
            'password' => '$2y$10$XHtF9jpQJcBE.o4dFZWC0.HAPID04jlrRz3HRkquh2xhe/IDV7ro2',
            'responsable' => '',
        ])->assignRole('Administrador');
        User::create([
            'nombre' => 'donacion',
            'apPaterno' => 'de organos',
            'apMaterno' => '',
            'login' => 'donacion',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => 'donacionorganos@salud.cdmx.gob.mx', 
            'password' => '$2y$10$NpV8a/0BG9mbUM4jYoe7cegTQbLYtvt5fQDaWyIK295gpcITnIJ3S',
            'responsable' => '',
        ])->assignRole('Administrador');
        User::create([
            'nombre' => 'MARA',
            'apPaterno' => 'CAMACHO',
            'apMaterno' => 'SANTAMARIA',
            'login' => 'HGVILLA',
            'area' => '', 
            'unidad' => '53',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => 'maracamacho@hotmail.com', 
            'password' => '$2y$10$IUlMHCw2RMEOJ2sAlCObnO/kJogmJTqa5EVpPg6QcCtq66GGbOYzq',
            'responsable' => '',
        ])->assignRole('Administrador');
        User::create([
            'nombre' => 'YURI',
            'apPaterno' => 'JIMENEZ',
            'apMaterno' => 'MARTINEZ',
            'login' => 'Yuri',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => 'yurijimtz0105@gmail.com', 
            'password' => '$2y$10$pkIAEw6.wPXwX.lDZ0sUNe.Pm4rrxH4ZGpKlwt8VRSerkeN2Cmp7O',
            'responsable' => '',
        ])->assignRole('consulta');
        User::create([
            'nombre' => 'NAYELLI IVETTE',
            'apPaterno' => 'CALDERON',
            'apMaterno' => 'LOPEZ',
            'login' => 'nayelic',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'false',
            'email' => 'nayelicalderon.21@gmail.com', 
            'password' => '$2y$10$Lb3s.77Ge.KiRk4KbrC3J.QB2QtVAUY3fQ7nxJnqcXbt1TuJ4HFIi',
            'responsable' => '',
        ])->assignRole('inactivo');

            //Nuevo
        User::create([
            'nombre' => 'JOSELYN BRIGGETH',
            'apPaterno' => 'PEREZ',
            'apMaterno' => 'GONZALEZ',
            'login' => 'JBPG',
            'area' => '', 
            'unidad' => '5',
            'fechaAlta' => '',
            'telefono' => '',
            'activo' => 'true',
            'email' => 'briggethperez.2007@gmail.com', 
            'password' => 'SEDESA2026',
            'responsable' => '',
        ])->assignRole('developer');
    }
}
