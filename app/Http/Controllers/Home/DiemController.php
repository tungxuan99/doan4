<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVienModel;
use App\Models\MonHocModel;
use App\Models\DiemModel;
use App\Models\LopHocModel;
use App\Models\HocSinhModel;
use Illuminate\Support\Facades\Crypt;

class DiemController extends Controller
{
    public function Xemdiem($id)
    {
        // $data = Crypt::decrypt($id);
    	$diems = DiemModel::Where('MaHS',$id)->get();
    	$hs= HocSinhModel::Where('MaHS',$id)->first();
    	$ten=$hs->TenHS;
    	$_SESSION['dsmh']=MonHocModel::all();
    	return view('homeview.xemdiem',compact('diems','ten'));
    }
    public function PHxemdiem($id)
    {
        $data = Crypt::decrypt($id);
        $diems = DiemModel::Where('MaHS',$data)->Where('MaHocKy','22019')->get();
        $hs= HocSinhModel::Where('MaHS',$data)->first();
        $ten=$hs->TenHS;
        $ma=$hs->MaHS;
        $_SESSION['dsmh']=MonHocModel::all();
        return view('homeview.xemdiem',compact('diems','ten','ma'));
    }
    public function home(){
        return view('homeview.home');
    }
    public function slogin(){
        return view('homeview.hsdangnhap');
    }
    public function kt(Request $request)
    {
        $dshs = HocSinhModel::All();
        foreach ($dshs as $hs) {
            if (($hs->MaHS)==($request->MaHS) and ($hs->passwordhs)==($request->passwordhs)) {
            	return redirect()->route('diems', [$hs->MaHS]);
                // $diems = DiemModel::Where('MaHS',$request->MaHS)->get();
                // $_SESSION['dsmh']=MonHocModel::all();
                // $ten=$hs->TenHS;
                // return view('homeview.xemdiem',compact('diems','ten'));
            }
        }
        return view('homeview.hsdangnhap');
    }
    public function tradiemhk()
    {
        return view('homeview.diemhk');
    }
    public function diemhk(Request $req)
    {
        $string=$req->string;
        $hocsinhs = HocSinhModel::where('MaHS',$req->string)->orWhere('TenHS','like', '%'.$req->string.'%')->get();
        $diems= array();
        if(count($hocsinhs)>0) {
            $dsmh=MonHocModel::all();
            foreach ($hocsinhs as $hs) {
                $tmp = DiemModel::Where('MaHS',$hs->MaHS)->Where('MaHocKy','22019')->orderBy('MaMonHoc', 'ASC')->get();
                foreach($tmp as $tmp1){
                    array_push($diems,[
                        'MaMonHoc'=>$tmp1->MaMonHoc,
                        'MaHS'=>$tmp1->MaHS,
                        'DiemHK'=>$tmp1->DiemHK
                    ]);
                }
            }
            return view('homeview.diemhk',compact('hocsinhs','diems','dsmh','string'));
        }
        else {
            return redirect()->back()->with(['message'=>'Dữ liệu nhập không đúng! Mời nhập lại!']);
        }
    }
}
