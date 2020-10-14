@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Quản lý học sinh</h3>
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
                <h2>Danh sách học sinh</h2>
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
                    <table id="datatable" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>TT</th>
                              <th>Mã học sinh</th>
                              <th>Mã lớp</th>
                              <th>Họ tên</th>
                              <th>Giới tính</th>
                              <th>Ngày sinh</th>
                              <th>In học bạ</th>
                          </tr>
                      </thead>
                      <tbody id="hs-list" name="hs-list">
                      @isset($hocsinhs)
                      <?php $tt=1;?>
                      @foreach($hocsinhs as $hs)
                          <tr id="hs{{$hs->MaHS }}">
                              <td><?php echo $tt++; ?></td>
                              <td>{{ $hs->MaHS }}</td>
                              <td>{{ $hs->MaLopHoc }}</td>
                              <td>{{ $hs->TenHS }}</td>
                              <td>{{ $hs->GioiTinh }}</td>
                              <td>{{ date('d-m-Y', strtotime($hs->NgaySinh)) }}</td>
                              <td><a class="btn btn-info open-modal" href="/admin/hb-hoc-sinh/pdf/{{$hs->MaHS}}">
                                    In
                                  </a>
                              </td>
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
  @push('scripts')
  <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    @endpush
@endsection