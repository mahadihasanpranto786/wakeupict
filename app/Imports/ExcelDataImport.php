<?php

namespace App\Imports;

use App\Model\ExcelData;
use App\model\ExcelName;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;
// use Maatwebsite\Excel\Concerns\ToModel;

class ExcelDataImport implements ToCollection, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $rows)
    {

        $excel_name_id = ExcelName::insertGetId(['date' => Carbon::now()]);
        // dd($excel_name_id);
        foreach ($rows as $row)
        {
            ExcelData::create([
                'excel_name_id' => $excel_name_id,
                'hash_tag' => $row[0],
                'keyword' => $row[1],
                'position' => $row[2],
                'position_history' => $row[3],
                'volume' => $row[4],
                'url' => $row[5],
                'difficulty' => $row[6],
                'cpc' => $row[7],
            ]);
        }
    }
}