<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        $path = base_path().'/database/seeds/csv/instituciones.csv';
        
        $file = fopen($path, 'r');
        
        $puntoDeCorte = 0; 
        $filaActual = 0;
        $lote = [];

        $nombreTabla = (new \App\Institucion)->getTable();

        while (($row = fgetcsv($file, 0, ';')) !== FALSE) {
            
            if ($filaActual <= $puntoDeCorte) {
                $filaActual++;
                continue;
            }

            $lote[] = [
                'idInsti' => $row[0] ?? null,
                'instiPro'    => $row[1] ?? null,
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
