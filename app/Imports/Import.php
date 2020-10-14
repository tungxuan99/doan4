<?php

namespace App\Imports;

use App\Models\DiemModel;
use Maatwebsite\Excel\Concerns\ToModel;

class Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DiemModel([
            'MaLopHoc'=>$row[0],
            'TenLopHoc'=>$row[1],
            'KhoiHoc'=>$row[2]
        ]);
    }
}
