<?php

use Illuminate\Database\Seeder;
use Keboola\Csv\CsvReader;
use Illuminate\Support\Facades\DB;

class alcaldiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::disableQueryLog();
    $path = base_path().'/database/seeds/csv/municipiosacaldias.csv';
    
    $file = fopen($path, 'r');
    
    $puntoDeCorte = 1; 
    $filaActual = 0;
    $lote = [];

    $nombreTabla = (new \App\alcaldiaModel)->getTable();

    while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
        
        if ($filaActual <= $puntoDeCorte) {
            $filaActual++;
            continue;
        }

        $lote[] = [
            'ClaveEntidad' => $row[0] ?? null,
            'ClaveMuni'    => $row[1] ?? null,
            'ClaveLoc'     => $row[2] ?? null,
            'Entidad'      => $row[3] ?? null,
            'Municipio'    => $row[5] ?? null, 
            'Localidad'    => $row[6] ?? null,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];

        $filaActual++;

        if (count($lote) >= 1000) {
            
            DB::table($nombreTabla)->insert($lote);
            $this->command->info("Insertando lote. Fila actual del archivo: $filaActual");
            $lote = [];
        }
    }

    if (!empty($lote)) {
        DB::table($nombreTabla)->insert($lote);
    }

    fclose($file);
    $this->command->info("¡Listo! Se procesó usando la tabla: $nombreTabla");
}
}