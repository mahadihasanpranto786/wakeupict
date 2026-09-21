<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;
class TestUserImport implements ToModel, WithStartRow
{

        
 
    public function startRow(): int
    {
        return 2;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        return new User([
           'name' =>  $row[0],
           'email' => $row[1],
           'nid_number' => $row[2],
           'employee_type' => $row[3],
           'type' => @$row[4],
        //    'email_verified_at' => $row[5],
           'password' => Hash::make(@$row[5]),
        ]);
    }
}
