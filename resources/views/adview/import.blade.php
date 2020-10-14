@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Quản lý lớp học</h3>
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
                <h2>Danh sách lớp học</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <form action="{{ route('import')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <h3><i class="fa fa-file-excel-o"></i>Excel import</h3>
                  <div class="form-group">
                    <input type="file" name="file" accept=".xlsx">
                  </div>
                  <div>
                    <button type="btn btn-primary" type="submit">Import</button>
                  </div>
                </form>
                @if(Session::has('flag'))
                <div class="alert alert-{{Session::get('flag')}}">
                  {{Session::get('message')}}
                </div>
                @endif
                  <div class="table-responsive">
                    {{-- <table id="datatable" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                               <th>TT</th>
                                <th>Mã lớp học</th>
                                <th>Tên lớp học</th>
                                <th>Khối học</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="lh-list" name="lh-list">
                        @isset($lophocs)
                          <?php $tt=1;?>
                          @foreach($lophocs as $lp)
                              <tr id="lp{{$lp->MaLopHoc }}"> 
                                  <td><?php echo $tt++; ?></td>
                                  <td>{{ $lp->MaLopHoc }}</td>
                                  <td>{{ $lp->Tenlophoc }}</td>
                                  <td>{{ $lp->KhoiHoc }}</td>
                                  <td><button class="btn btn-info open-modal" value="{{$lp->MaLopHoc}}">
                                      Sửa
                                    </button>
                                  </td>
                                  <td><button class="btn btn-danger delete-lp" value="{{$lp->MaLopHoc}}">
                                        Xóa
                                      </button>
                                  </td>
                              </tr>
                          @endforeach
                        @endisset
                        </tbody>
                    </table> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
  </div>
@endsection