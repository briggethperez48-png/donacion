<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/database/seeds/csv/hist_usuarios.csv';
        $nombreTabla = 'hist_usuarios'; // Asegúrate de que este es el nombre real

        // Aquí listas las columnas que SÍ vienen en tu CSV, en el orden correcto
        $query = sprintf(
            "COPY %s (id_usuario, nombre_usuario, paterno_usuario, materno_usuario, login, password, id_modulo, id_status) FROM '%s' WITH (FORMAT csv, HEADER true, DELIMITER ',')",
            $nombreTabla,
            str_replace('\\', '/', $path) // Postgres prefiere barras inclinadas
        );

        DB::statement($query);
    }
}
