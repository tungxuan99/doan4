<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVienModel;
use App\Models\MonHocModel;
use App\Models\DiemModel;
use App\Models\LopHocModel;
use App\Models\HocSinhModel;
use App\Models\UserModel;

class QLGiaoVienController extends Controller
{
    public function index()
    {
    	$data=GiaoVienModel::All();
        $_SESSION['dsmh']=MonHocModel::all();
    	return view('adview.giaovien')->with('giaoviens',$data);
    }
    public function edit($id){
    	$db=GiaoVienModel::Where('Magv',$id)->first();
        //$db=LopHocModel::find($id);
    	return response()->json($db);	
    }
    public function create(Request $request){
    	$db=new GiaoVienModel();
    	$db->Magv=$request->Magv;
    	$db->MaMonHoc=$request->MaMonHoc;
    	$db->Tengv=$request->Tengv;
    	$db->DiaChi=$request->DiaChi;
    	$db->SDT=$request->SDT;
    	$db->passwordgv=$request->passwordgv;
    	$db->save();
        $user=new UserModel();
        $user->fullname=$request->Tengv;
        $user->username=$request->Magv;
        $user->password=bcrypt($request->passwordgv);
        $user->level=1;
        $user->save();
    	return response()->json($db);	
    }
    public function put(Request $request, $id){
        $db=GiaoVienModel::Where('Magv',$id)->update(array('Tengv'=>$request->Tengv,'DiaChi'=>$request->DiaChi,'SDT'=>$request->SDT,'passwordgv'=>$request->passwordgv));
        $db=GiaoVienModel::Where('Magv',$id)->first();
    	return response()->json($db);	
    }
    public function delete($id){
        $db=GiaoVienModel::Where('Magv',$id)->delete();
    	return response()->json($db);  	
    }
}
