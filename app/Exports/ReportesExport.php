<?php

namespace App\Exports;

use App\Reporte;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ReportesExport implements FromCollection, WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Reporte::select('EstadoID', 'MunicipioID', 'Estado', 'Municipio', 'Clave')->get();
    }
    public function headings() {
        return ['EstadoID', 'MunicipioID', 'Estado', 'Municipio', 'Clave'];
    }
}
