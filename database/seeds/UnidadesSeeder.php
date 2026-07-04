<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        $path = base_path().'/database/seeds/csv/unidades.csv';
        
        $file = fopen($path, 'r');
        
        $puntoDeCorte = 0; 
        $filaActual = 0;
        $lote = [];

        $nombreTabla = (new \App\Unidad)->getTable();

        while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
            
            if ($filaActual <= $puntoDeCorte) {
                $filaActual++;
                continue;
            }

            $lote[] = [
                'unidad' => $row[0] ?? null,
                'CLUES'    => $row[1] ?? null,
                'idInsti'    => $row[2] ?? null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            $filaActual++;

            if (count($lote) >= 100) {
                
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
