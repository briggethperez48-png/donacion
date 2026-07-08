<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistDonantesSeeder extends Seeder
{
    public function run()
    {
        DB::disableQueryLog();
        
        $path = base_path().'/database/seeds/csv/hist_donadores.csv';
        
        if (!file_exists($path)) {
            $this->command->error("No se encontró el archivo en: $path");
            return;
        }

        $file = fopen($path, 'r');
        $lote = [];
        
        fgetcsv($file, 0, ','); 

        while (($row = fgetcsv($file, 0, ',')) !== FALSE) {
            // 1. Si la línea no empieza con un ID numérico, está corrupta por las comillas. La saltamos.
            if (empty($row[0]) || !is_numeric($row[0])) continue;

            // 2. FILTRO RADICAL: Validamos que las posiciones existan y sean numéricas.
            // Si traen texto como "frente al salón...", las mandamos como NULL para no tronar la base de datos.
            $id_sexo_viejo      = isset($row[4])  && is_numeric($row[4])  ? $row[4]  : null;
            $id_est_civil_viejo = isset($row[6])  && is_numeric($row[6])  ? $row[6]  : null;
            $id_estudios_viejo  = isset($row[8])  && is_numeric($row[8])  ? $row[8]  : null;
            $alcaldia_vieja     = isset($row[10]) && is_numeric($row[10]) ? $row[10] : null;
            $colonia_vieja      = isset($row[11]) && is_numeric($row[11]) ? $row[11] : null;
            $id_tipo_viejo      = isset($row[17]) && is_numeric($row[17]) ? $row[17] : null;
            $id_entidad_vieja   = isset($row[21]) && is_numeric($row[21]) ? $row[21] : null;
            $id_religion_viejo  = isset($row[22]) && is_numeric($row[22]) ? $row[22] : null;
            $donador_viejo      = isset($row[24]) && is_numeric($row[24]) ? $row[24] : null;

            $lote[] = [
                'id_donador'   => (int)$row[0],
                
                'Nombre'       => !empty($row[1]) ? substr($row[1], 0, 191) : null,
                'ApPaterno'    => !empty($row[2]) ? substr($row[2], 0, 191) : null,
                'ApMaterno'    => !empty($row[3]) ? substr($row[3], 0, 191) : null,
                
                'Sexo'         => $this->buscarIdCatalogo('Sexo', $id_sexo_viejo),
                'FechaNac'     => !empty($row[5]) ? $row[5] : null,
                'EstCiv'       => $this->buscarIdCatalogo('EstCiv', $id_est_civil_viejo),
                
                'Ocupacion'    => !empty($row[7]) ? substr($row[7], 0, 191) : null,
                'Estudios'     => $this->buscarIdCatalogo('Estudios', $id_estudios_viejo),
                'CP'           => !empty($row[9]) ? substr($row[9], 0, 10) : null,
                
                // Forzamos a que si Postgres espera enteros en la migración, vayan limpios
                'Alcaldia'     => $alcaldia_vieja,
                'Colonia'      => $colonia_vieja,
                
                'Calle'        => !empty($row[12]) ? substr($row[12], 0, 191) : null,
                'NumExt'       => !empty($row[13]) ? substr($row[13], 0, 50) : null,
                'NumInt'       => !empty($row[14]) ? substr($row[14], 0, 50) : null,
                'Telefono'     => !empty($row[15]) ? substr($row[15], 0, 50) : null,
                'Referencias'  => !empty($row[16]) ? substr($row[16], 0, 191) : null,
                
                'Tipo'         => $this->buscarIdCatalogo('Tipo', $id_tipo_viejo),
                'Fecha'        => !empty($row[18]) ? $row[18] : null,
                'Hora'         => !empty($row[19]) ? $row[19] : null,
                
                'CURP'         => !empty($row[20]) ? substr($row[20], 0, 18) : null,
                'estadoNac'    => $id_entidad_vieja,
                'Religion'     => $this->buscarIdCatalogo('Religion', $id_religion_viejo),
                
                'EstadoProc'   => 'Nuevo',
                'Donador'      => $donador_viejo,
                
                'created_at'   => now(),
                'updated_at'   => now(),
            ];

            if (count($lote) >= 250) {
                DB::table('donantes')->insert($lote);
                $lote = [];
            }
        }

        if (!empty($lote)) {
            DB::table('donantes')->insert($lote);
        }

        fclose($file);
        $this->command->info("¡Muestra de donantes histórica migrada con éxito!");
    }

    /**
     * Mapeador blindado contra textos accidentales
     */
    private function buscarIdCatalogo($tipo, $idHistViejo)
    {
        // Si no es un número válido, ni buscamos en la tabla para evitar errores de PDO
        if ($idHistViejo === null || $idHistViejo === '' || !is_numeric($idHistViejo)) {
            return null;
        }

        return DB::table('catalogos')
            ->where('tipo', $tipo)
            ->where('hist_valor', (string)$idHistViejo)
            ->value('id_catalogo');
    }
}