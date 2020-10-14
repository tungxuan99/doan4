<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LopHocModel extends Model
{
	public $timestamps= false;
    protected $table='lophoc';
    protected $fillable =[
    	'MaLopHoc', 'TenLopHoc', 'KhoiHoc'
    ];
}
