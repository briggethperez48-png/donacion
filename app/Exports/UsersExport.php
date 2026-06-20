<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class UsersExport implements FromView, ShouldAutoSize, WithEvents {
    protected $request;

    
    public function __construct($request) {
        $this->request = $request;
    }

    public function view(): View {
        
        $users = User::withTrashed()
            ->with(['roles', 'relacionArea', 'administrador'])
            ->when($this->request->mesIni, function ($q) {
                return $q->whereDate('created_at', '>=', $this->request->mesIni);
            })
            ->when($this->request->mesFin, function ($q) {
                return $q->whereDate('created_at', '<=', $this->request->mesFin);
            })
            ->when($this->request->roles, function ($q) {
                return $q->role($this->request->roles);
            })
            ->when($this->request->area, function ($q) {
                return $q->where('area', $this->request->area);
            })
            ->when($this->request->status, function ($q) {
                if ($this->request->status == 'INACTIVO') {
                    return $q->whereNotNull('deleted_at');
                } else {
                    return $q->whereNull('deleted_at');
                }
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('exports.usersExport', [
            'users' => $users
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