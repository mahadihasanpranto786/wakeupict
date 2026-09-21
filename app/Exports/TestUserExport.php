<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TestUserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'NID',
            'Employee',
            'Type',
            'Password',
        ];
    }
    public function collection()
    {
        return User::select('name', 'email', 'nid_number', 'employee_type', 'type')->get();
    }
}
