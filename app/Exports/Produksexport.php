<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Excel\Sheet;


class Produksexport implements FromCollection, WithHeadings, WithTitle, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Produk::all();
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth(5); //no
                $event->sheet->getColumnDimension('B')->setAutoSize(True); //nama produk
                $event->sheet->getColumnDimension('C')->setAutoSize(True); //created at
                $event->sheet->getColumnDimension('D')->setAutoSize(True); //Updated at

                //judul atas
                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->mergeCells('A2:D2');
                $event->sheet->setCellValue('A1', "DATA PRODUK DI MARKET");
                $event->sheet->SetCellValue('A2', "PER TANGGAL " . date('d M Y'));

                //style
                // $event->sheet->getStyle('A1:B2')->getFont->setBold(true);
                $event->sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                //border
                $event->sheet->getStyle('A4:D' . $event->sheet->getHighestRow())->ApplyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' =>  \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_DASHDOT,
                            'color' => ['rgb' => '0000ff'],
                        ],
                    ],
                ]);
            }
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Created At',
            'Updated At'
        ];
    }

    public function title(): string
    {
        return 'Data';
    }
}
