@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Quản lý điểm </h3>
          </div>
          
          <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Tìm!</button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>
        
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                @isset($lops)
                <form action="{{route('quanly.xemdiem')}}" method="post" accept-charset="utf-8">
                  @csrf
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label class="col-md-4 col-form-label">Chọn lớp</label>
                      <div class="col-md-8">
                        <select name="MaLopHoc" class="form-control">
                          @foreach($lops as $lp)
                          <option value="{{$lp->MaLopHoc}}">{{$lp->Tenlophoc}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label class="col-md-4 col-form-label">Chọn kỳ học</label>
                      <div class="col-md-8">
                        <select name="HocKy" class="form-control">
                          <option value="1">Học kỳ 1</option>
                          <option value="2">Học kỳ 2</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label class="col-md-4 col-form-label">Chọn năm học</label>
                      <div class="col-md-8">
                        <select name="NamHoc" class="form-control">
                          <option value="2019">2019-2020</option>
                          <option value="2018">2018-2019</option>
                          <option value="2017">2017-2018</option>                      
                        </select>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" class="btn btn-info">Gửi</button>
                    </div>
                </div>
                </form>
                @endisset
                @isset($hocsinhs)
                <h2>Danh sách học sinh</h2>
                <ul class="nav navbar-right panel_toolbox">
                  {{-- <li>Lớp: <input type="text" size="5" name="lop" value="{{$lop}}" class="btn btn-secondary" readonly="true"> --}}
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
              
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>TT</th>
                                <th>Tên học sinh</th>
                                <th>Ngày sinh</th>
                                @foreach($dsmh as $mh)
                                <th>{{$mh->TenMonHoc}}</th>
                                @endforeach
                                <th>Điểm TB</th>
                            </tr>
                        </thead>
                        <tbody >
                        @isset($hocsinhs)
                        <?php $tt=1; ?>
                          @foreach($hocsinhs as $hs)
                              <tr> 
                                  <td><?php echo $tt++; ?></td>
                                  <td>{{ $hs->TenHS }}</td>
                                  <td>{{ date('d-m-Y', strtotime($hs->NgaySinh))}}</td>
                                  {{-- @foreach($diems as $diem)
                                    @if($diem->MaHS==$hs->MaHS)
                                      <td>{{$diem->DiemTB}}</td>
                                    @else
                                    <td></td>
                                    @endif
                                  @endforeach --}}
                                  <?php
                                    if(count($diems)>0)
                                    {
                                      $diemTB=0;
                                      foreach($diems as $diem)
                                      {
                                          if($diem->MaHS==$hs->MaHS)
                                          {
                                            echo "<td>".$diem->DiemTB."</td>";
                                            if(($diem->MaMonHoc=='T')|| ($diem->MaMonHoc=='V'))
                                            {
                                              $diemTB+=($diem->DiemTB)*2;
                                            }
                                            else{
                                              $diemTB+=$diem->DiemTB;
                                            }
                                          }

                                      }
                                      $diemTB=$diemTB/(count($dsmh)+2);
                                      echo "<td><strong>".round($diemTB,2)."<strong></td>";
                                    }else{
                                      foreach($dsmh as $mh)
                                      {
                                          echo "<td></td>";
                                      }
                                    }
                                  ?>
                              </tr>
                          @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
                @endisset
              </div>
            </div>
          </div>
        </div>
  </div>
@endsection