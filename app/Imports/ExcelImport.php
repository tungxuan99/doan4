<?php

namespace App\Imports;

use App\Models\LopHocModel;
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
        return new LopHocModel([
            // 'MaHocKy' =>$row[0],
            // 'MaMonHoc' =>$row[1],
            // 'MaHS' =>$row[2],
            // 'MaLopHoc' =>$row[3],
            // 'MaMonHoc' =>$row[4],
            // 'DiemMieng' =>$row[5],
            // 'Diem10Phut' =>$row[6],
            // 'Diem1Tiet' =>$row[7],
            // 'DiemHK' =>$row[8],
            // 'DiemTB' =>$row[9],
            'MaLopHoc'=>$row[0],
            'TenLopHoc'=>$row[1],
            'KhoiHoc'=>$row[2]
        ]);
    }
}
