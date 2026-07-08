<?php

use Illuminate\Database\Seeder;
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
    $path = base_path().'/database/seeds/csv/codigoPostal.csv';
    
    $file = fopen($path, 'r');
    
    $puntoDeCorte = 0; 
    $filaActual = 0;
    $lote = [];

    $nombreTabla = (new \App\alcaldiaModel)->getTable();

    while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
        
        if ($filaActual <= $puntoDeCorte) {
            $filaActual++;
            continue;
        }

        $lote[] = [
            'd_codigo' => $row[0] ?? null,
            'd_asenta'    => $row[1] ?? null,
            'd_tipo_asenta'     => $row[2] ?? null,
            'D_mnpio'      => $row[3] ?? null,
            'd_estado'    => $row[4] ?? null, 
            'd_ciudad'    => $row[5] ?? null,
            'd_CP'    => $row[6] ?? null,
            'c_estado'    => $row[7] ?? null,
            'c_oficina'    => $row[8] ?? null,
            'c_CP'    => $row[9] ?? null,
            'c_tipo_asenta'    => $row[10] ?? null,
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