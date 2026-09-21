<?php

namespace App\Exports;

use App\Model\ExcelData;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ExcelDataExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function id(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function headings(): array
    {
        return [
            '#',
            'Keyword',
            'Position',
            'Position History',
            'Volumn',
            'Url',
            'Difficulty',
            'CPC',
        ];
    }
    public function query()
    {
        // dd($this->id);
        return ExcelData::query()->where('excel_name_id', $this->id)->select('hash_tag', 'keyword', 'position', 'position_history', 'volume', 'url', 'difficulty', 'cpc');
// dd($excelData);

    }
    // public function FromQuery()
    // {
    //     // $excelData =  ExcelData::where('excel_name_id', 3)->get();
    //     // dd($this->invoices->all());
    //     return ExcelData::where('excel_name_id', 2)->get();
    // }
}