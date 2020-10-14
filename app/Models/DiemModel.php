<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiemModel extends Model
{
    protected $table='diem';
    protected $fillable=[
    	'MaHocKy',
    	'MaMonHoc',
    	'MaHS',
    	'MaLopHoc',
    	'DiemMieng',
    	'Diem15Phut',
    	'Diem1Tiet',
    	'DiemHK',
    	'DiemTB'
    ];
    protected $primaryKey='id';
}
