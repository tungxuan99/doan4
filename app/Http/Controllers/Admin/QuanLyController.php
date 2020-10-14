<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GiaoVienModel;
use App\Models\MonHocModel;
use App\Models\DiemModel;
use App\Models\LopHocModel;
use App\Models\HocSinhModel;
use App\Models\DiemDanhModel;
use App\Models\CTDDModel;
use App\Models\UserModel;
use App\Exports\UsersExport;
use App\Imports\DiemImport;
use App\Imports\Import;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


use App\Mail\SendMail;


// use Auth;

class QuanLyController extends Controller
{
    public function index()
    {
        $lops= LopHocModel::All();
        return view('adview.diemdanh')->with('lops',$lops);
    }
    public function DiemDanh(Request $request)
    {
        $lops= LopHocModel::All();
        $ngay= Carbon::now();
        $db=DiemDanhModel::Where('MaLopHoc',$request->MaLop)
                            ->Where('NgayDD',$ngay->toDateString())
                            ->Where('Buoi',$request->Buoi)->get();
        if (Count($db)==0) {
            $hocsinhs=HocSinhModel::Where('MaLopHoc',$request->MaLop)->get();
            $lop=$request->MaLop;
            $Buoi=$request->Buoi;
            return view('adview.diemdanh',compact('hocsinhs','lop', 'Buoi'));
        }else {
            return redirect()->back()->with(['message'=>'Lớp đã điểm danh!','lops'=>$lops]);
        }
		
    }
    public function create(Request $request)
    {
        $lops= LopHocModel::All();
        $db=new DiemDanhModel();
        $db->MaLopHoc=$request->Lop;
        $db->Magv=Auth::user()->username;
        $ngay= Carbon::now();
        $db->NgayDD=$ngay->toDateString();
        $db->Buoi=$request->Buoi;
        $db->save();
        $db1=DiemDanhModel::Where('MaLopHoc',$request->Lop)
                            ->Where('Magv',Auth::user()->username)
                            ->Where('NgayDD',$ngay->toDateString())
                            ->Where('Buoi',$request->Buoi)->first();
    	$hocsinhs=HocSinhModel::Where('MaLopHoc',$request->Lop)->get();
        $dem=0;
        foreach($hocsinhs as $hs)
        {
            $MaDD= $db1->MaDD;
            $MaHS= $hs->MaHS;
            $tt="TrangThai".$dem;
            $TrangThai=$request->$tt;
            $dem++;
            $this->story($MaDD,$MaHS,$TrangThai);
        }
        return view('adview.diemdanh')->with(['success'=>'Điểm danh thành công!','lops'=>$lops]);

    }
    public function story($MaDD, $MaHS, $TrangThai)
    {
        $db=new CTDDModel();
        $db->MaDD=$MaDD;
        $db->MaHS=$MaHS;
        $db->TrangThai=$TrangThai;
        $db->save();
    }
    //Thêm điểm
    public function diemindex()
    {
        $lops= LopHocModel::All();
        $monhocs= MonHocModel::All();
        return view('adview.themdiem',compact('monhocs','lops'));
    }
    public function ThemDiem(Request $request)
    {
        $hocsinhs=HocSinhModel::Where('MaLopHoc',$request->MaLopHoc)->orderBy('TenHS', 'ASC')->get();
        $lop=$request->MaLopHoc;
        $monhoc=$request->MonHoc;
        return view('adview.themdiem',compact('hocsinhs','lop','monhoc'));
    }
    public function creatediem(Request $request)
    {
        $hocsinhs=HocSinhModel::Where('MaLopHoc',$request->lop)->orderBy('TenHS', 'ASC')->get();
        $dem1=0;
        foreach($hocsinhs as $hs)
        {
            // dd($hs);
            $db=new DiemModel();
            // $db->MaHocKy=$request->MaHocKy;
            $db->MaHocKy="22019";
            $db->MaMonHoc=$request->mon;
            $db->MaHS=$hs->MaHS;
            $db->MaLopHoc=$hs->MaLopHoc;
            $DiemMieng='DiemMieng'.$dem1;
            $db->DiemMieng=$request->$DiemMieng;
            $Diem15phut='Diem15phut'.$dem1;
            $db->Diem15phut=$request->$Diem15phut;
            $Diem1Tiet='Diem1Tiet'.$dem1;
            $db->Diem1Tiet=$request->$Diem1Tiet;
            $DiemHK='DiemHK'.$dem1;
            $db->DiemHK=$request->$DiemHK;
            //tính điểm tb
            $tbmieng=0;
            $dem=0;
            if(strpos($request->$DiemMieng, ",") !== false)
            {
                $tmp1=explode(',', $request->$DiemMieng);
                foreach($tmp1 as $d)
                {
                    $dem++;
                    $tbmieng+=(float)($d);
                }
                $tbmieng=$tbmieng/$dem;
            }
            else{ $tbmieng=(float)($request->$DiemMieng);}
            $tb15p=0;
            $dem=0;
            if(strpos($request->$Diem15phut, ",") !== false)
            {
                $tmp2=explode(',', $request->$Diem15phut);
                foreach($tmp2 as $d)
                {
                    $dem++;
                    $tb15p+=(float)($d);
                }
                $tb15p=$tb15p/$dem;
            }
            else{ $tb15p=(float)($request->$Diem15phut);}
            $tb1tiet=0;
            $dem=0;
            if(strpos($request->$Diem1Tiet, ",") !== false)
            {
                $tmp3=explode(',', $request->$Diem1Tiet);
                foreach($tmp3 as $d)
                {
                    $dem++;
                    $tb1tiet+=(float)($d);
                }
                $tb1tiet=$tb1tiet/$dem;
            }
            else{ $tb1tiet=(float)($request->$Diem1Tiet);}
            $tb=($tbmieng)+($tb15p)+($tb1tiet)*2+($request->$DiemHK)*3;
            $tb=$tb/7;
            $db->DiemTB=round($tb,2);
            $db->save();
            $dem1++;
        }
        return redirect()->back()->with(['message'=>'Thêm điểm thành công!']);
    }
    //Sửa điểm
    public function SuaDiemIndex()
    {
        $lops= LopHocModel::All();
        $monhocs= MonHocModel::All();
        return view('adview.suadiem',compact('monhocs','lops'));
    }
    public function SuaDiem(Request $request)
    {
        $hocsinhs=HocSinhModel::leftjoin('diem','hocsinh.MaHS','=','diem.MaHS')->Where('diem.MaLopHoc',$request->MaLopHoc)->Where('diem.MaMonHoc',$request->MonHoc)->Where('diem.MaHocKy','22019')->orderBy('TenHS', 'ASC')->get();
        $lop=$request->MaLopHoc;
        $monhoc=$request->MonHoc;
        return view('adview.suadiem',compact('hocsinhs','lop','monhoc'));
    }
    public function updatediem(Request $request)
    {
        $hocsinhs=HocSinhModel::leftjoin('diem','hocsinh.MaHS','=','diem.MaHS')->Where('diem.MaLopHoc',$request->lop)->Where('diem.MaMonHoc',$request->mon)->orderBy('TenHS', 'ASC')->get();
        $dem1=0;
        foreach($hocsinhs as $hs)
        {
            $db=DiemModel::find($hs->id);
            $db->MaHocKy="22019";
            $db->MaMonHoc=$request->mon;
            $db->MaHS=$hs->MaHS;
            $db->MaLopHoc=$hs->MaLopHoc;
            $DiemMieng='DiemMieng'.$dem1;
            $db->DiemMieng=$request->$DiemMieng;
            $Diem15phut='Diem15phut'.$dem1;
            $db->Diem15phut=$request->$Diem15phut;
            $Diem1Tiet='Diem1Tiet'.$dem1;
            $db->Diem1Tiet=$request->$Diem1Tiet;
            $DiemHK='DiemHK'.$dem1;
            $db->DiemHK=$request->$DiemHK;
            //tính điểm tb
            $tbmieng=0;
            $dem=0;
            if(strpos($request->$DiemMieng, ",") !== false)
            {
                $tmp1=explode(',', $request->$DiemMieng);
                foreach($tmp1 as $d)
                {
                    $dem++;
                    $tbmieng+=(float)($d);
                }
                $tbmieng=$tbmieng/$dem;
            }
            else{ $tbmieng=(float)($request->$DiemMieng);}
            $tb15p=0;
            $dem=0;
            if(strpos($request->$Diem15phut, ",") !== false)
            {
                $tmp2=explode(',', $request->$Diem15phut);
                foreach($tmp2 as $d)
                {
                    $dem++;
                    $tb15p+=(float)($d);
                }
                $tb15p=$tb15p/$dem;
            }
            else{ $tb15p=(float)($request->$Diem15phut);}
            $tb1tiet=0;
            $dem=0;
            if(strpos($request->$Diem1Tiet, ",") !== false)
            {
                $tmp3=explode(',', $request->$Diem1Tiet);
                foreach($tmp3 as $d)
                {
                    $dem++;
                    $tb1tiet+=(float)($d);
                }
                $tb1tiet=$tb1tiet/$dem;
            }
            else{ $tb1tiet=(float)($request->$Diem1Tiet);}
            $tb=($tbmieng)+($tb15p)+($tb1tiet)*2+($request->$DiemHK)*3;
            $tb=$tb/7;
            $db->DiemTB=round($tb,2);
            $db->save();
            $dem1++;
        }
        return redirect()->back()->with(['message'=>'Sửa điểm thành công!']);
    }
    public function xemdiem()
    {
        $lops= LopHocModel::All();
        $monhocs= MonHocModel::All();
        return view('adview.adxemdiem',compact('monhocs','lops'));
    }
    public function dsdiem(Request $request)
    {
        $hocky=$request->HocKy.$request->NamHoc;
        $hocsinhs=HocSinhModel::Where('MaLopHoc',$request->MaLopHoc)->orderBy('TenHS', 'ASC')->get();
        $diems = DiemModel::select('MaMonHoc','MaHS','DiemTB')->Where('MaLopHoc',$request->MaLopHoc)->Where('MaHocKy',$hocky)->orderBy('MaMonHoc', 'ASC')->get();
        $dsmh=MonHocModel::orderBy('MaMonHoc', 'ASC')->get();
        return view('adview.adxemdiem',compact('hocsinhs','diems','dsmh'));
    }
    //Đăng ký
    public function getinfo()
    {
        return view('adview.dangky');
    }
    public function postinfo(Request $request)
    {
        $db=new UserModel();
        $db->fullname=$request->fullname;
        $db->username=$request->username;
        $db->password=bcrypt($request->password);
        $db->level=0;
        $db->save();
        return redirect()->back()->with(['message'=>'Đăng ký thành công']);
    }
    //Đăng nhập
    public function getLogin()
    {
        return view('adview.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'username' => 'required',
                'password'=>'required|min:4|max:20'
            ],
            [
                'username.required'=>'Vui lòng nhập username',
                'password.required'=>'Vui lòng nhập password',
                'password.min'=>'Mật khẩu ít nhất 4 ký tự',
                'password.max'=>'Mật khẩu không vượt quá 20 ký tự'
            ]
        );
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password])) {
            if (Auth::user()->level =='2') {
                return redirect()->route('diemhs');
            }
            else {
                
            return redirect()->route('admin.index');}
        }else {
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    //Đăng xuất
    public function postLogout()
    {
        Auth::logout();
        return redirect()->Route('login');
    }
    // public function updatetk(Request $request)
    // {
    //     $db=UserModel::Find(Auth::user()->id);
    //     $db->password
    //     return response()->json($db);
    // }
    ///Dieemr
    public function themtufile()
    {
        return view('adview.import');
    }
    public function postImport(Request $request)
    {
        $path= $request->file('file')->getRealPath();
        Excel::import(new DiemImport,$path);
        return back();
    }
    public function test()
    {
        $parameter='10110104';
        $parameter= Crypt::encrypt($parameter);
        return $parameter;

    }
    public function guidiem()
    {
        $data=HocSinhModel::All();
        $_SESSION['dslh']=LopHocModel::all();
        return view('adview.guidiem')->with('hocsinhs',$data);
    }
    public function sendmail(Request $request)
    {
        //mã hóa mã học sinh
        $parameter=$request->MaHS;
        $parameter= Crypt::encrypt($parameter);
        //Lấy thông tin học sinh
        $hocsinh= HocSinhModel::Where('MaHS',$request->MaHS)->first();
        $link="http://127.0.0.1:8000/xemdiem/".$parameter;
        $data=[
            'name'=>$hocsinh->TenHS,
            'lop'=>$hocsinh->MaLopHoc,
            'link'=>$link,
        ];
        Mail::to($request->Email)->send(new SendMail($data));
        return redirect()->back()->with(['message'=>'Gửi điểm thành công']);
    }

    //Học sinh xem điểm
    public function hsdiem()
    {
        if(Auth::check()){
            $diems = DiemModel::Where('MaHS',Auth::user()->username)->Where('MaHocKy','22019')->get();
            $hs= HocSinhModel::Where('MaHS',Auth::user()->username)->first();
            $_SESSION['dsmh']=MonHocModel::all();
            return view('adview.hsdiem',compact('diems'));
        }
    }
}
