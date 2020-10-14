<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVienModel;
use App\Models\MonHocModel;
use App\Models\DiemModel;
use App\Models\LopHocModel;
use App\Models\HocSinhModel;

class QLMonHocController extends Controller
{
     public function index()
    {
    	$data=MonHocModel::All();
    	return view('adview.monhoc')->with('monhocs',$data);
    }
    public function edit($id){
    	$db=MonHocModel::Where('MaMonHoc',$id)->first();
    	return response()->json($db);	
    }
    public function create(Request $request){
    	$db=new MonHocModel();
    	$db->MaMonHoc=$request->MaMonHoc;
    	$db->TenMonHoc=$request->TenMonHoc;
    	$db->SoTiet=$request->SoTiet;
    	$db->HeSoMonHoc=$request->HeSoMonHoc;
    	$db->save();
    	return response()->json($db);	
    }
    public function put(Request $request, $id){
    	$db=MonHocModel::Where('MaMonHoc',$id)->update(array('TenMonHoc'=>$request->TenMonHoc,'SoTiet'=>$request->SoTiet,'HeSoMonHoc'=>$request->HeSoMonHoc));
       $db=MonHocModel::Where('MaMonHoc',$id)->first();
    	return response()->json($db);	
    }
    public function delete($id){
        $db=MonHocModel::Where('MaMonHoc',$id)->delete();
    	return response()->json($db);  	
    }
}
