<?php

namespace App\Exports;

use App\Models\Invitado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ConfirmadosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private int $rowNumber = 0;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Invitado::whereNotNull('nombre_completo')
            ->where('nombre_completo', '!=', '')
            ->whereHas('user', function ($query) {
                $query->where('rol', 'Invitado');
            })
            ->with('user')
            ->get()
            ->sortBy(function ($invitado) {
                return ($invitado->user->nombre_familia ?? '') . ' ' . $invitado->nombre_completo;
            });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            '#',
            'Familia',
            'Nombre del Invitado',
            'Cabaña',
            'Boletos Familia',
            'Fecha Límite',
        ];
    }

    /**
     * @param Invitado $invitado
     * @return array
     */
    public function map($invitado): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $invitado->user->nombre_familia ?? 'N/A',
            $invitado->nombre_completo,
            ($invitado->user->opcion_cabana ?? false) ? 'Sí' : 'No',
            $invitado->user->cantidad_boletos ?? 1,
            $invitado->user->fecha_limite ? $invitado->user->fecha_limite->format('d/m/Y') : 'N/A',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $lastRow = $this->rowNumber + 1;

        // Estilos para la cabecera
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '92A68C'], // Salvia
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(26);

        // Alineación de datos
        if ($lastRow > 1) {
            $sheet->getStyle("A2:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("D2:F{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            // Bordes suaves en toda la tabla
            $sheet->getStyle("A1:F{$lastRow}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'DCD6CD'],
                    ],
                ],
            ]);
        }

        return [];
    }
}
