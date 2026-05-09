<?php

namespace App\Exports;

use App\Donante;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportesExport implements FromQuery, WithHeadings {
    protected $request;

    public function __construct($request) {
        $this->request = $request;
    }

    public function query() {
        // Aplicamos exactamente los mismos filtros que en el controlador
        return Donante::query()
            ->when($this->request->mesIni, function ($q) {
                return $q->where('created_at', '>=', $this->request->mesIni . '-01');
            })
            ->when($this->request->EstadoProc, function ($q) {
                return $q->where('EstadoProc', $this->request->EstadoProc);
            })
            ->when($this->request->Sexo && $this->request->Sexo != 'TODOS', function ($q) {
                return $q->where('Sexo', $this->request->Sexo);
            })
            ->when($this->request->Organo, function ($q) {
                return $q->where(function($sub) {
                    foreach($this->request->Organo as $org) {
                        $sub->orWhere('Organo', 'LIKE', '%' . $org . '%');
                    }
                });
            });
    }

    public function headings(): array {
        return ['ID', 'Nombre',
            'ApPaterno',
            'ApMaterno',
            'FechaNac',
            'Ocupacion',
            'EstCiv',
            'Estudios',
            'EstadoProc',
            'Religion',
            'CURP',
            'Sexo',
            'estadoNac',
            'Alcaldia',
            'Colonia',
            'Donador',
            'Organo',
            'Referencias',
            'Telefono',
            'Pregunta',
            'Respuesta',
            'updated_at',
            'created_at'
            ];
    }
}
