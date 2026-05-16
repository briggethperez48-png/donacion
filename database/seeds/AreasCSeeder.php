<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
    DB::disableQueryLog();
    $path = base_path().'/database/seeds/csv/areas.csv';
    
    $file = fopen($path, 'r');
    
    $puntoDeCorte = 1; 
    $filaActual = 0;
    $lote = [];

    $nombreTabla = (new \App\Area)->getTable();

    while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
        
        if ($filaActual <= $puntoDeCorte) {
            $filaActual++;
            continue;
        }

        $lote[] = [
            'idArea' => $row[0] ?? null,
            'area'    => $row[1] ?? null,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];

        $filaActual++;

        if (count($lote) >= 10) {
            
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