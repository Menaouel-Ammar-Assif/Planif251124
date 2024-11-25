<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class ActionDirecteurExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        // $this->direction = $direction;
    }

    public function collection()
    {
        return collect($this->data)->map(function ($item) {
            return [
                'Structure Centrale' => $item->code_act ?? 'N/A',
                'Actions' => $item->lib_act ?? 'N/A',
                'Date Debut' => $item->dd ?? 'N/A',
                'Date Fin' => $item->df ?? 'N/A',
                'Avancement' => isset($item->etat) ? $item->etat . '%' : 'N/A',
            ];
        })->values(); // Re-index the collection to start from 0 each time
    }

    public function headings(): array
    {
        return [
            'Code',
            'Actions',
            'Date Debut',
            'Date Fin',
            'Avancement',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 16,
            'B' => 110,
            'C' => 18,
            'D' => 18,
            'E' => 16,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to header row (first row)
        $styles = [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ff004cff'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];

        $excelRow = 2;
        foreach ($this->data as $row) {
            // Log the row to confirm correct indexing if needed
            \Log::info("Excel Row: $excelRow, Etat: " . ($row->etat ?? 'N/A'));
    
            // Apply conditional styles based on 'etat' value
            if (isset($row->etat) && (int)$row->etat === 100) {
                $sheet->getStyle("E{$excelRow}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFF']],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF00FF00'],
                    ],
                    'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ]);
            } elseif (isset($row->etat) && (int)$row->etat < 100) {
                $sheet->getStyle("E{$excelRow}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['argb' => '000000']],
                    'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ]);
            }
    
            // Apply styles to other columns as needed
            $sheet->getStyle("A{$excelRow}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => '000000'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]);
    
            $sheet->getStyle("B{$excelRow}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => '000']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ff91d2ff'],
                ],
            ]);
    
            $sheet->getStyle("C{$excelRow}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => '000']],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]);
    
            $sheet->getStyle("D{$excelRow}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => '000']],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]);
    
            // Increment row counter for each entry in data
            $excelRow++;
        }
    
        return $styles;
    }
}
