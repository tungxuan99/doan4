@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Trường THPT Đa Phúc</h3>
          </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Thông tin</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                                <th>Mã hoc sinh</th>
                                <th>Tên học sinh</th>
                                <th>Lớp học</th>
                                <th>Điểm TB</th>
                            </tr>
                        </thead>
                        <tbody >
                        @isset($hocsinhs)
                        <?php $tt=1; ?>
                          @foreach($hocsinhs as $hs)
                              <tr> 
                                  <td><?php echo $tt++; ?></td>
                                  <td>{{ $hs->MaHS }}</td>
                                  <td>{{ $hs->TenHS }}</td>
                                  <td>{{ $hs->MaLopHoc }}</td>
                                  <td>{{ $hs->DiemTB }}</td>
                              </tr>
                          @endforeach
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