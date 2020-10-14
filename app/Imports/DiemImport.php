<?php

namespace App\Imports;

use App\Models\DiemModel;
use Maatwebsite\Excel\Concerns\ToModel;

class DiemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DiemModel([
            'MaHocKy' =>$row[0],
            'MaMonHoc' =>$row[1],
            'MaHS' =>$row[2],
            'MaLopHoc' =>$row[3],
            'DiemMieng' =>$row[4],
            'Diem15Phut' =>$row[5],
            'Diem1Tiet' =>$row[6],
            'DiemHK' =>$row[7],
            'DiemTB' =>$row[8]
        ]);
    }
}
