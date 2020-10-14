@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Bảng điểm</h3>
          </div>
        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Danh sách điểm</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="table-responsive">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                <tr>
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
                                    <td>{{ $diem->DiemTB }}</td>
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
                              <td colspan="6" style="text-align: right;">Điểm trung bình:</td>
                              <td >{{round($diemtb/(count($_SESSION['dsmh'])+2),2)}}</td>
                            </tr>
                            @endisset
                            
                            </tbody>
                        </table>
                    </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection