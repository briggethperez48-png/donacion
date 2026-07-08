<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/database/seeds/csv/cat_modulos.csv';
        $nombreTabla = 'cat_modulos'; // Asegúrate de que este es el nombre real

        // Aquí listas las columnas que SÍ vienen en tu CSV, en el orden correcto
        $query = sprintf(
            "COPY %s (id_modulo, descripcion_modulo) FROM '%s' WITH (FORMAT csv, HEADER true, DELIMITER ',')",
            $nombreTabla,
            str_replace('\\', '/', $path) // Postgres prefiere barras inclinadas
        );

        DB::statement($query);
    }
}
