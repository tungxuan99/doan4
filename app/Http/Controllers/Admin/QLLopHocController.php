<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVienModel;
use App\Models\MonHocModel;
use App\Models\DiemModel;
use App\Models\LopHocModel;
use App\Models\HocSinhModel;

class QLLopHocController extends Controller
{
    public function index()
    {
    	$data=LopHocModel::All();
    	return view('adview.lophoc')->with('lophocs',$data);
    }
    public function edit($id){
    	$db=LopHocModel::Where('MaLopHoc',$id)->first();
        //$db=LopHocModel::find($id);
    	return response()->json($db);	
    }
    public function create(Request $request){
    	$db=new LopHocModel();
    	$db->MaLopHoc=$request->MaLopHoc;
    	$db->Tenlophoc=$request->Tenlophoc;
    	$db->KhoiHoc=$request->KhoiHoc;
    	$db->save();
    	return response()->json($db);	
    }
    public function put(Request $request, $id){
        // $db=LopHocModel::Where('MaLopHoc',$id)->first();
    	$db=LopHocModel::Where('MaLopHoc',$id)->update(array('Tenlophoc'=>$request->Tenlophoc,'KhoiHoc'=>$request->KhoiHoc));
    	// $db->Tenlophoc=$request->Tenlophoc;
    	// $db->KhoiHoc=$request->KhoiHoc;
    	//$db->save();
       $db=LopHocModel::Where('MaLopHoc',$id)->first();
    	return response()->json($db);	
    }
    public function delete($id){
        $db=LopHocModel::Where('MaLopHoc',$id)->delete();
    	return response()->json($db);  	
    }
}
