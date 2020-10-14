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

class QLHocSinhController extends Controller
{
    public function index()
    {
    	$data=HocSinhModel::All();
    	$_SESSION['dslh']=LopHocModel::all();
    	return view('adview.hocsinh')->with('hocsinhs',$data);	
    }
    public function edit($id){
        $db=HocSinhModel::Where('MaHS',$id)->first();
        $db->NgaySinh=date('d-m-Y', strtotime($db->NgaySinh));
        return response()->json($db);   
    }
    public function create(Request $request){
        $db=new HocSinhModel();
        $db->MaHS=$request->MaHS;
        $db->MaLopHoc=$request->MaLopHoc;
        $db->TenHS=$request->TenHS;
        $db->GioiTinh=$request->GioiTinh;
        $db->NgaySinh=date('Y-m-d', strtotime($request->NgaySinh));
        $db->noisinh=$request->noisinh;
        $db->dantoc=$request->dantoc;
        $db->hotencha=$request->hotencha;
        $db->hotenme=$request->hotenme;
        $db->passwordhs=$request->passwordhs;
        $db->save();
        $db->NgaySinh=$request->NgaySinh;
        $user=new UserModel();
        $user->fullname=$request->TenHS;
        $user->username=$request->MaHS;
        $user->password=bcrypt($request->passwordhs);
        $user->level=2;
        $user->save();
        return response()->json($db);   
    }
    public function put(Request $request, $id){
        $db=HocSinhModel::Where('MaHS',$id)->update(array('TenHS'=>$request->TenHS,'MaLopHoc'=>$request->MaLopHoc,'GioiTinh'=>$request->GioiTinh,'NgaySinh'=>date('Y-m-d', strtotime($request->NgaySinh)),'noisinh'=>$request->noisinh,'dantoc'=>$request->dantoc,'hotencha'=>$request->hotencha,'hotenme'=>$request->hotenme,'passwordhs'=>bcrypt($request->passwordhs)));
       $db=HocSinhModel::Where('MaHS',$id)->first();
       $db->NgaySinh=$request->NgaySinh;
        return response()->json($db);   
    }
    public function delete($id){
        $db=HocSinhModel::Where('MaHS',$id)->delete();
        return response()->json($db);   
    }
    public function khoi($khoi)
    {
		$lop= LopHocModel::Where('KhoiHoc',$khoi)->select('MaLopHoc')->get();
		$hocsinhs=HocSinhModel::WhereIn('MaLopHoc',$lop)->get();
		$_SESSION['dslh']=LopHocModel::all();
        $kh=$khoi;
        return view('adview.hocsinh',compact('hocsinhs','kh'));
    }
    public function lop($lop)
    {
		$hocsinhs=HocSinhModel::Where('MaLopHoc',$lop)->get();
		$_SESSION['dslh']=LopHocModel::all();
        $lh=$lop;
        return view('adview.hocsinh',compact('hocsinhs','lh'));
    }
}
