<?php

namespace App\Exports;

use App\Models\CopValeur;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class CopValeurExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $data;
    private $d;
    public function collection()
    {
        $year = date('Y');

        // Fetch data with 'ecartType' included for internal use
        $this->data = DB::table('copValeurs as cv')
            ->whereMonth('cv.periode', '03')
            ->whereYear('cv.periode', $year)
            ->join('indicateurs as ind', 'cv.id_ind', '=', 'ind.id_ind')
            ->join('objectifs as obj', 'cv.id_obj', '=', 'obj.id_obj')
            ->join('copCibles as cc', 'cv.id_cop_cible', '=', 'cc.id_cop_cible')
            ->select(
                'obj.lib_obj',
                'ind.lib_ind',
                'ind.formule',
                DB::raw("CONCAT(cv.result, ' ', cc.unite) AS result"),
                DB::raw("CONCAT(cc.cible, ' ', cc.unite) AS cible_with_unit"),
                // 'cv.ecart',
                DB::raw("CONCAT(cv.ecart, ' %') AS ecart"),
                'cv.ecartType',
                DB::raw("CONCAT(cc.\"cibleTrimestre\", ' ', cc.unite) AS cibleT_with_unit"),
                // 'cv.ecartP',
                DB::raw("CONCAT(cv.\"ecartP\", ' %') AS ecartP"),
                'cv.ecartTypeP',
            )
            ->orderBy('cv.id_ind')
            ->get();
            return $this->data;

    }


    public function headings(): array
    {
        return [
            'Objectif',
            'Indicateur',
            'Mode de calcul',
            'Resultat',
            'Cible Annuelle',
            'Ecart Annuel',
            'Ecart Type Annuel',
            'Cible Trimestriel ',
            'Ecart Trimestriel ',
            'Ecart Type Trimestriel',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 45,
            'B' => 45,
            'C' => 35,
            'D' => 18,
            'E' => 17,
            'F' => 13,
            'H' => 17,
            'I' => 13,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to header row (first row)
        $styles = [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']], // White text color
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ff004cff'], // primary background color
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    
        
        foreach ($this->data as $index => $row) {
            $excelRow = $index + 2;
    
            if (isset($row->ecartType) && $row->ecartType == 'positif') {
                $sheet->getStyle("F{$excelRow}")->applyFromArray([
                    'font' => ['color' => ['argb' => 'FFFFFFFF']], // Green
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'ff1dac6d'],
                    ],
                    'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ]);
            } elseif (isset($row->ecartType) && $row->ecartType == 'négatif') {
                $sheet->getStyle("F{$excelRow}")->applyFromArray([
                    'font' => ['color' => ['argb' => 'FFFF0000']],
                    'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ]);
            }


            if (isset($row->ecartTypeP) && $row->ecartTypeP == 'positif') {
                $sheet->getStyle("I{$excelRow}")->applyFromArray([
                    'font' => ['color' => ['argb' => 'FFFFFFFF']],
                    'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ff1dac6d'],
                    ],
                    'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ]);
            } elseif (isset($row->ecartTypeP) && $row->ecartTypeP == 'négatif') {
                $sheet->getStyle("I{$excelRow}")->applyFromArray([
                    'font' => ['color' => ['argb' => 'FFFF0000']],
                    'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                ]);
            }

            $sheet->getStyle("A{$excelRow}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ff975d6b'],
                ],
            ]);

            $sheet->getStyle("B{$excelRow}")->applyFromArray([
                // 'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ff91d2ff'],
                ],
            ]);

            $sheet->getStyle("D{$excelRow}")->applyFromArray([
                // 'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'ffe2e2e2'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]);
            $sheet->getStyle("E{$excelRow}")->applyFromArray([
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]);

            $sheet->getStyle("H{$excelRow}")->applyFromArray([
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ]);
        }
    
        return $styles;
    }
    
}
