<?php

namespace App\Imports;

use App\Reporte;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReportesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Reporte([
            'EstadoID'=>$row['idest'],
            'MunicipioID'=>$row['idmuni'],
            'Estado'=>$row['estado'],
            'Municipio'=>$row['municipio'],
            'Clave'=>$row['cveinegi']
        ]);
    }
}
