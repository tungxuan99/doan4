@extends('layouts.home.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Điểm học sinh</h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="clearfix"></div>
                <h4>Mã học sinh: {{$ma}}</h4>
                 <h4>Họ tên: {{$ten}}</h4>                    
                @isset($diems)
                    <div class="table-responsive">
                        <table class="table table-bordered" style="background-color: #ffeeba" >
                            <thead style="background-color: #d9edf7" >
                                <tr >
                                    <th>TT</th>
                                    <th>Môn học</th>
                                    <th>Điểm miệng</th>
                                    <th>Điểm 15p</th>
                                    <th>Điểm 1 tiết</th>
                                    <th>Điểm HK</th>
                                    <th>Điểm TB</th>
                                </tr>
                            </thead>
                            <tbody>
                            @isset($diems)
                            <?php $tt=1; $diemtb=0;?>
                            @foreach($diems as $diem)
                                <tr>
                                    <td><?php echo $tt++; ?></td>
                                    <td><?php foreach( $_SESSION['dsmh'] as $mh){
                                            if(($diem->MaMonHoc)==($mh->MaMonHoc))
                                            {
                                                echo $mh->TenMonHoc;
                                                break;
                                            }
                                        } ?></td>
                                    <td>{{ $diem->DiemMieng }}</td>
                                    <td>{{ $diem->Diem15Phut }}</td>
                                    <td>{{ $diem->Diem1Tiet }}</td>
                                    <td>{{ $diem->DiemHK }}</td>
                                    <td><b>{{ $diem->DiemTB }}</b></td>
                                    <?php
                                      if($diem->MaMonHoc=='T'||$diem->MaMonHoc=='V')
                                      {
                                        $diemtb+=($diem->DiemTB)*2;
                                      }
                                      else{
                                        $diemtb+=($diem->DiemTB);
                                      }
                                    ?>
                                </tr>
                            @endforeach
                            <tr>
                              <td colspan="6" style="text-align: right;"><h4>Điểm trung bình:</h4></td>
                              <td ><h4>{{round($diemtb/(count($_SESSION['dsmh'])+2),2)}}</h4></td>
                            </tr>
                            @endisset
                            </tbody>
                        </table>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection

