<?php

namespace App\Exports;

use App\Donante;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Illuminate\Support\Facades\DB;

class ReportesExport implements FromView, ShouldAutoSize, WithEvents {
    protected $request;

    
    public function __construct($request) {
        $this->request = $request;
    }

    public function view(): View {
        // 1. CARGA DE CATÁLOGOS DE TRADUCCIÓN (Para evitar IDs en el Excel)
        $sexos        = DB::table('catalogos')->where('tipo', 'Sexo')->pluck('valor', 'id_catalogo');
        $estados_civ  = DB::table('catalogos')->where('tipo', 'EstCiv')->pluck('valor', 'id_catalogo');
        $estudios     = DB::table('catalogos')->where('tipo', 'Estudios')->pluck('valor', 'id_catalogo');
        $religiones   = DB::table('catalogos')->where('tipo', 'Religion')->pluck('valor', 'id_catalogo');
        $ocupaciones  = DB::table('catalogos')->where('tipo', 'Ocupacion')->pluck('valor', 'id_catalogo');
        $preguntas    = DB::table('catalogos')->where('tipo', 'Pregunta')->pluck('valor', 'id_catalogo');

        // Catálogos Geográficos oficiales de tu tabla
        $estados   = DB::table('municipiosalcaldias')->distinct()->pluck('d_estado', 'c_estado');
        $alcaldias = DB::table('municipiosalcaldias')->select('c_estado', 'c_mnpio', 'D_mnpio')->distinct()->get()
            ->mapWithKeys(function ($item) {
                return [$item->c_estado . '-' . $item->c_mnpio => $item->D_mnpio];
            });
        $colonias  = DB::table('municipiosalcaldias')->pluck('d_asenta', 'id');

        // 2. CONSULTA CON FILTROS HOMOLOGADOS (Sincronizado con tu ReporteController)
        $donadores = Donante::query()
            ->with('organos')
            ->when($this->request->filled('mesIni'), function ($q) {
                return $q->whereDate('created_at', '>=', $this->request->mesIni);
            })
            ->when($this->request->filled('mesFin'), function ($q) {
                return $q->whereDate('created_at', '<=', $this->request->mesFin);
            })
            ->when($this->request->filled('estadoNac'), function ($q) {
                return $q->where('estadoNac', $this->request->estadoNac);
            })
            ->when($this->request->filled('Alcaldia'), function ($q) {
                return $q->where('Alcaldia', $this->request->Alcaldia);
            })
            ->when($this->request->filled('Colonia'), function ($q) {
                return $q->where('Colonia', $this->request->Colonia);
            })
            ->when($this->request->filled('Sexo') && $this->request->Sexo != 'TODOS', function ($q) {
                return $q->where('Sexo', $this->request->Sexo);
            })
            ->when($this->request->has('Organo') && is_array($this->request->Organo) && count($this->request->Organo) > 0, function ($q) {
                $q->whereHas('organos', function($sub) {
                    $sub->whereIn('organos.id_organo', $this->request->Organo);
                });
            })
            ->orderBy('id_donador', 'desc')
            ->get();

        // Enviamos todas las traducciones indexadas a la vista del Excel
        return view('exports.donantesExport', [
            'donadores'   => $donadores,
            'sexos'       => $sexos,
            'estados_civ' => $estados_civ,
            'estudios'    => $estudios,
            'religiones'  => $religiones,
            'ocupaciones' => $ocupaciones,
            'preguntas'   => $preguntas,
            'estados'     => $estados,
            'alcaldias'   => $alcaldias,
            'colonias'    => $colonias
        ]);
    }
    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                //Imagen
                $drawing = new Drawing();
                $drawing->setName('Logo Institucional');
                $drawing->setDescription('Logo');
                
                $drawing->setPath(public_path('css/imagen/SEDESANOV.png')); 
                $drawing->setHeight(60); 
                $drawing->setCoordinates('A1'); 
                $drawing->setOffsetX(10);
                $drawing->setOffsetY(5);
                $drawing->setWorksheet($sheet);

                //Dirección
                $sheet->setCellValueExplicit('F2', 'SECRETARÍA DE SALUD PÚBLICA DE LA CIUDAD DE MÉXICO', DataType::TYPE_STRING);
                $sheet->getStyle('A1:V5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Roboto'
                    ]
                ]);
                
                //Celdas
                    //Título unido
                $sheet->getRowDimension('6')->setRowHeight(20);
                $sheet->mergeCells('A6:V6');
                $sheet->getStyle('A6:V6')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => '55585a'], 
                        'size' => 13,
                        'name' => 'Roboto'
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'fff']
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]
                ]);

                foreach (range('A', 'V') as $columnID) {
                    $sheet->getColumnDimension($columnID)->setWidth(30);
                }
                
                    //Encabezados
                $sheet->getRowDimension('7')->setRowHeight(50);

                $sheet->getStyle('A7:V7')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFAE9'], 
                        'size' => 13,
                        'name' => 'Roboto'
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '9D2148']
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]
                ]);
                
                    //Celdas restantes
                $sheet->getStyle('A8:V110')->applyFromArray([
                    'font' => [
                        'bold' => false,
                        'color' => ['rgb' => '55585a'], 
                        'size' => 11,
                        'name' => 'Roboto'
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ]
                ]);
            },
        ];
    }
}