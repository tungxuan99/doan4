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
use DB;
use PDF;

class ThongKeController extends Controller
{
    public function ViewTKMon()
    {
        $kyhoc= '22019';
        $monhocs= MonHocModel::All();
        $diem= DiemModel::select('MaLopHoc',DiemModel::raw('ROUND((SUM(DiemTB)/COUNT(*)),2) as value'))
                ->Where('MaHocKy',$kyhoc)
                ->Where('MaMonHoc','T')
                ->groupBy('MaLopHoc')
                ->orderBy('MaLopHoc', 'ASC')
                ->get();
        $mon="";
        foreach ($monhocs as $mh) {
            if($mh->MaMonHoc=='A')
            {
                $mon=$mh->TenMonHoc;
                break;
            }
        }
        return view('adview.thongkediem',compact('diem','monhocs','mon'));
    }
    public function PostTKMon(Request $request)
    {
        $kyhoc= $request->Ky.$request->NamHoc;
        $monhocs= MonHocModel::All();
    	$diem= DiemModel::select('MaLopHoc',DiemModel::raw('ROUND((SUM(DiemTB)/COUNT(*)),2) as value'))
    			->Where('MaHocKy',$kyhoc)
    			->Where('MaMonHoc',$request->MonHoc)
    			->groupBy('MaLopHoc')
    			->orderBy('MaLopHoc', 'ASC')
    			->get();
        $mon="";
        foreach ($monhocs as $mh) {
            if($mh->MaMonHoc==$request->MonHoc)
            {
                $mon=$mh->TenMonHoc;
                break;
            }
        }
    	return view('adview.thongkediem',compact('diem','monhocs','mon'));
    }
    public function TOP10Diem()
    {
        $hocsinhs=DB::table('top10diem')->get();
        return view('adview.TOP10Diem', compact('hocsinhs'));
    }
    public function DSHocSinh()
    {
        $hocsinhs= HocSinhModel::All();
        $_SESSION['dslh']=LopHocModel::all();
        return view('adview.InHocBa',compact('hocsinhs'));
    }
    public function pdf($MaHS)
    {
        // $pdf = \App::make('dompdf.wrapper');
        // $pdf->loadHTML($this->convert_customer_data_to_html());
        // return $pdf->stream();
        $hocba=$this->convert_customer_data_to_html($MaHS);
        return $hocba;
    }
    public function convert_customer_data_to_html($MaHS)
    {
        $hs= HocSinhModel::Where('MaHS',$MaHS)->first();
        $diem=DiemModel::Where('MaHS',$MaHS)->Where('MaHocKy','22019')->orWhere('MaHocKy','12019')->get();
        $Toan1="";
        $Anh1="";
        $Hoa1="";
        $Sinh1="";
        $CN1="";
        $Van1="";
        $Su1="";
        $Tin1="";
        $GD1="";
        $Toan2="";
        $Anh2="";
        $Hoa2="";
        $Sinh2="";
        $CN2="";
        $Van2="";
        $Su2="";
        $Tin2="";
        $GD2="";
        foreach($diem as $d)
        {
            switch ($d->MaMonHoc) {
                case 'T':
                    if($d->MaHocKy=='22019')
                        {$Toan2=$d->DiemTB;}else {
                        $Toan1=$d->DiemTB;
                        }
                    
                    break;
                case 'A':
                    if($d->MaHocKy=='22019')
                        {$Anh2=$d->DiemTB;}else {
                        $Anh1=$d->DiemTB;
                        }
                    break;
                case 'CN':
                    if($d->MaHocKy=='22019')
                        {$CN2=$d->DiemTB;}else {
                        $CN1=$d->DiemTB;
                        }
                    break;
                case 'GD':
                    if($d->MaHocKy=='22019')
                        {$GD2=$d->DiemTB;}else {
                        $GD1=$d->DiemTB;
                        }
                    break;
                case 'H':
                    if($d->MaHocKy=='22019')
                        {$Hoa2=$d->DiemTB;}else {
                        $Hoa1=$d->DiemTB;
                        }
                    break;
                case 'Si':
                    if($d->MaHocKy=='22019')
                        {$Sinh2=$d->DiemTB;}else {
                        $Sinh1=$d->DiemTB;
                        }
                    break;
                case 'S':
                    if($d->MaHocKy=='22019')
                        {$Su2=$d->DiemTB;}else {
                        $Su1=$d->DiemTB;
                        }
                    break;
                case 'Ti':
                    if($d->MaHocKy=='22019')
                        {$Tin2=$d->DiemTB;}else {
                        $Tin1=$d->DiemTB;
                        }
                    break;
                case 'V':
                    if($d->MaHocKy=='22019')
                        {$Van2=$d->DiemTB;}else {
                        $Van1=$d->DiemTB;
                        }
                    break;      
                default:
                    // code...
                    break;
            }
        }
        $HK1=Round(($Toan1*2+$Anh1+$Hoa1+$Sinh1+$CN1+$Van1*2+$Su1+$Tin1+$GD1)/11,2);
        $HK2=Round(($Toan2*2+$Anh2+$Hoa2+$Sinh2+$CN2+$Van2*2+$Su2+$Tin2+$GD2)/11,2);
        $output="<html lang='en'>
                <head>
                    <meta charset='utf-8'>
                    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                </head>
                <body>
                    <div style='margin-left:400px;margin-top:50px;'>
                        
                        <b>Họ và tên:</b>{$hs->TenHS}<b>&emsp;&emsp;&emsp;Lớp:</b>{$hs->MaLopHoc}<b>&emsp;&emsp;&emsp;Năm học:</b>2019-2020
                        <br><br>
                        <table border='1' width='600px' style='text-align: center;'>
                            <tr>
                                <td rowspan='2'>Môn học</td>
                                <td colspan='3'>Điểm trung bình môn học</td>
                                <td rowspan='2'>Điểm thi lại(nếu có)</td>
                            </tr>
                            <tr>
                                <td>HK1</td>
                                <td>HK2</td>
                                <td>Cả năm</td>
                            </tr>
                            <tr>
                                <td>Toán</td>
                                <td>{$Toan1}</td>
                                <td>{$Toan2}</td>
                                <td>";
                                $output.=Round(($Toan1+$Toan2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Anh</td>
                                <td>{$Anh1}</td>
                                <td>{$Anh2}</td>
                                <td>";
                                $output.=Round(($Anh1+$Anh2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hóa học</td>
                                <td>{$Hoa1}</td>
                                <td>{$Hoa2}</td>
                                <td>";
                                $output.=Round(($Hoa1+$Hoa2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Sinh học</td>
                                <td>{$Sinh1}</td>
                                <td>{$Sinh2}</td>
                                <td>";
                                $output.=Round(($Sinh1+$Sinh2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Công nghệ</td>
                                <td>{$CN1}</td>
                                <td>{$CN2}</td>
                                <td>";
                                $output.=Round(($CN1+$CN2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Văn</td>
                                <td>{$Van1}</td>
                                <td>{$Van2}</td>
                                <td>";
                                $output.=Round(($Van1+$Van2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Lịch sử</td>
                                <td>{$Su1}</td>
                                <td>{$Su2}</td>
                                <td>";
                                $output.=Round(($Su1+$Su2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tin</td>
                                <td>{$Tin1}</td>
                                <td>{$Tin2}</td>
                                <td>";
                                $output.=Round(($Tin1+$Tin2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Giáo dục công dân</td>
                                <td>{$GD1}</td>
                                <td>{$GD2}</td>
                                <td>";
                                $output.=Round(($GD1+$GD2 * 2)/3,2); 
                                $output.="</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Điểm trung bình</b></td>
                                <td><b>{$HK1}</b></td>
                                <td><b>{$HK2}</b></td>
                                <td><b>";
                                $output.=Round(($HK1+$HK2 * 2)/3,2); 
                                $output.="</b></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </body>
                </html>";
        return $output;
    }
}
