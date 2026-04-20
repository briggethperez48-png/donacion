<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvReader;

class alcaldiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path().'/database/seeds/csv/municipiosacaldias.csv';
        
        // CAMBIO: Usamos ';' como delimitador
        $csv = new CsvReader($path, ';');

        foreach($csv as $index => $row) {
            // Saltamos la primera fila (encabezados)
            if ($index === 0) {
                continue;
            }

            \App\alcaldiaModel::create([
                'ClaveEntidad' => $row[0],
                'ClaveMuni'    => $row[1],
                'ClaveLoc'     => $row[2],
                'Entidad'      => $row[3],
                // 'Abreviatura'  => $row[4],
                'Municipio'    => $row[5], // El índice 4 suele ser la abreviatura, el 5 es el nombre
                'Localidad'    => $row[6], 
            ]);
        }
    }
}
