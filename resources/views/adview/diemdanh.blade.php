@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Quản lý điểm danh</h3>
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
                <form action="{{route('quanly.diemdanh')}}" method="post" accept-charset="utf-8">
                  @csrf
                  <div class="form-group row">
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Chọn lớp</label>
                    <div class="col-md-8">
                      <select name="MaLop" class="form-control">
                        @foreach($lops as $lp)
                        <option value="{{$lp->MaLopHoc}}">{{$lp->Tenlophoc}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Buổi học</label>
                    <div class="col-md-8">
                      <select name="Buoi" class="form-control">
                        <option value="Sang">Sáng</option>
                        <option value="Chieu">Chiều</option>
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
                  <div class="alert alert-danger">
                    <li>{{Session::get('message')}}</li>
                  </div>
                @endif
                @if(Session::has('success'))
                  <div class="alert alert-success">
                    <li>{{Session::get('success')}}</li>
                  </div>
                @endif
                @isset($hocsinhs)
                <form action="{{ route('quanly.create') }}" method="post" accept-charset="utf-8">
                 @csrf
                <h2>Danh sách học sinh</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>Lớp: <input type="text" size="5" name="Lop" value="{{$lop}}" class="btn btn-secondary" readonly="true">
                  <li>Buổi: <input type="text" size="5" name="Buoi" value="{{$Buoi}}" class="btn btn-secondary" readonly="true">
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
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>TT</th>
                                <th>Mã học sinh</th>
                                <th>Tên học sinh</th>
                                <th>Giới tính</th>
                                <th>Trạng thái</th>
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
                                  <td class="text-center">
                                    <div class="form-group row">
                                      <div class="col-sm-4">
                                        <input checked="checked" name="TrangThai<?php echo $tt-2; ?>" id="TrangThai<?php echo $tt-2; ?>" type="radio" value="0" />Có
                                      </div>
                                      <div class="col-sm-4">
                                        <input name="TrangThai<?php echo $tt-2; ?>" id="TrangThai<?php echo $tt-2; ?>" type="radio" value="1" />Không
                                      </div>
                                    </div> 
                                  </td>
                                  {{-- <td align="center">
                                    <select class="form-control" name="TrangThai<?php echo $tt-2; ?>" id="TrangThai<?php echo $tt-2; ?>">
                                      <option value="0">Có</option>
                                      <option value="1">Không</option>
                                    </select>
                                  </td> --}}
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