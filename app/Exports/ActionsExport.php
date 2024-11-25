<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ActionsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnWidths
{

    protected $data;
    protected $direction;

    public function __construct($data, $direction)
    {
        $this->data = $data;
        $this->direction = $direction;
    }

    public function collection()
{
    

    // Use $this->data directly without any additional filtering
    $collection = collect($this->data);
    $direction = collect($this->direction);

    // Map through $direction and filter data accordingly
    $filteredData = $direction->flatMap(function ($dir) use ($collection) 
    {
        // Filter items from $collection where id_dir matches
        $filteredItems = $collection->filter(function ($item) use ($dir) 
        {
            return $dir->id_dir == $item->id_dir;
        })->map(function ($filteredItem) use ($dir) 
        {
            // Transform filtered items
            return 
            [
                'Direction' => $dir->code . ' - ' . $dir->lib_dir,
                'lib_act' => $filteredItem->lib_act,
                'dd' => $filteredItem->dd,
                'df' => $filteredItem->df,
                'etat' => isset($filteredItem->etat) ? $filteredItem->etat . '%' : 'N/A'
            ];
        });

        return $filteredItems;
    });

    return $filteredData;
}
    
    public function headings(): array
    { 

        return 
        [
            'Structure Centrale',
            'Actions',
            'Date Debut',
            'Date Fin',
            'Avencement',          
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 125,
            'C' => 16,
            'D' => 16,
            'E' => 12,
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
                // 'alignment' => [
                //     'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                // ],
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