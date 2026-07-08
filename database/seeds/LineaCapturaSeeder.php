<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineaCapturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/database/seeds/csv/linea_captura.csv';
        $nombreTabla = 'linea_capturas'; // Asegúrate de que este es el nombre real

        // Aquí listas las columnas que SÍ vienen en tu CSV, en el orden correcto
        $query = sprintf(
            "COPY %s (id_linea_captura, id_donador, linea_captura, id_status, fecha_generada, fecha_pago) FROM '%s' WITH (FORMAT csv, HEADER true, DELIMITER ',')",
            $nombreTabla,
            str_replace('\\', '/', $path) // Postgres prefiere barras inclinadas
        );

        DB::statement($query);
    }
}
