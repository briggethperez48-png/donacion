<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonanteOrganoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        
        $path = base_path().'/database/seeds/csv/hist_organos_donados.csv';
        
        if (!file_exists($path)) {
            $this->command->error("No se encontró el archivo CSV en: $path");
            return;
        }

        $file = fopen($path, 'r');
        $lote = [];
        
        // Omitir cabecera del CSV viejo
        fgetcsv($file, 0, ','); 

        while (($row = fgetcsv($file, 0, ',')) !== FALSE) {
            if (empty($row[0]) || empty($row[1])) continue;

            $lote[] = [
                'id_donador' => $row[1], // ID del donador
                'id_organo'  => $row[2], // ID del órgano
            ];

            // Insertamos en lotes grandes (La pivote al ser ligera aguanta bloques de 1,000)
            if (count($lote) >= 1000) {
                DB::table('donante_organo')->insert($lote);
                $lote = [];
            }
        }

        if (!empty($lote)) {
            DB::table('donante_organo')->insert($lote);
        }

        fclose($file);
        $this->command->info("¡Tabla pivote vinculada con éxito!");
    }
}
