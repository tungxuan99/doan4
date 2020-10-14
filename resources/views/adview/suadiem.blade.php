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
                <form action="{{route('quanly.suadiem')}}" method="post" accept-charset="utf-8">
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
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Chọn môn</label>
                    <div class="col-md-8">
                      <select name="MonHoc" class="form-control">
                        @foreach($monhocs as $mh)
                        <option value="{{$mh->MaMonHoc}}">{{$mh->TenMonHoc}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-info">Gửi</button>
                  </div>
                </div>
                </form>
                @endisset
                @if(Session::has('message'))
                <div class="alert alert-success">
                  {{Session::get('message')}}
                </div>
                @endif
                @isset($hocsinhs)
                <form action="{{ route('quanly.updatediem') }}" method="post" accept-charset="utf-8">
                @csrf
                <h2>Danh sách học sinh</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>Lớp: <input type="text" size="5" name="lop" value="{{$lop}}" class="btn btn-secondary" readonly="true">
                  <li>Môn: <input type="text" size="5" name="mon" value="{{$monhoc}}" class="btn btn-secondary" readonly="true">
                  </li>
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
                                <th>Mã học sinh</th>
                                <th>Tên học sinh</th>
                                <th>Giới tính</th>
                                <th>Điểm Miệng</th>
                                <th>Điểm 15 phút</th>
                                <th>Điểm 1 tiết</th>
                                <th>Điểm học kỳ</th>
                            </tr>
                        </thead>
                        <tbody id="lh-list" name="lh-list">
                        @isset($hocsinhs)
                          <?php $tt=1;?>
                          @foreach($hocsinhs as $hs)
                              <tr id="hs{{$hs->MaHS }}"> 
                                  <td><?php echo $tt++; ?></td>
                                  <td>{{ $hs->MaHS }}</td>
                                  <td>{{ $hs->TenHS }}</td>
                                  <td>{{ $hs->GioiTinh }}</td>
                                  <td><input type="text" class="form-control" size="5" name="DiemMieng<?php echo $tt-2; ?>" value="{{$hs->DiemMieng}}" placeholder=""></td>
                                  <td><input type="text" class="form-control"size="5" name="Diem15phut<?php echo $tt-2; ?>" value="{{$hs->Diem15Phut}}" placeholder=""></td>
                                  <td><input type="text" class="form-control"size="5" name="Diem1Tiet<?php echo $tt-2; ?>" value="{{$hs->Diem1Tiet}}" placeholder=""></td>
                                  <td><input type="text" class="form-control"size="5" name="DiemHK<?php echo $tt-2; ?>" value="{{$hs->DiemHK}}" placeholder=""></td>
                              </tr>
                          @endforeach
                        @endisset
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-success" type="submit" name="luu" id="luu">Lưu tất cả</button>
                </form>
                @endisset
              </div>
            </div>
          </div>
        </div>
  </div>
@endsection