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
                  <li><select class="btn btn-secondary" id="lop" onchange="lopChanged(this)">
                        <option value=""> -- Chọn lớp -- </option>
                        @foreach($_SESSION['dslh'] as $lh)
                          <option value="{{$lh->MaLopHoc}}">{{$lh->Tenlophoc}}</option>
                        @endforeach
                      </select>
                  </li>
                  <li><select class="btn btn-secondary" id="khoi" onchange="khoiChanged(this)">
                        <option value=""> -- Chọn khối -- </option>
                        <option value="10">Khối 10</option>
                        <option value="11">Khối 11</option>
                        <option value="12">Khối 12</option>
                      </select>
                  </li>
                  <li><button class="btn btn-success" id="btn-add" name="btn-add">Thêm học sinh</button></li>
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
                              {{-- <th>TT</th> --}}
                              <th>Mã học sinh</th>
                              <th>Mã lớp</th>
                              <th>Họ tên</th>
                              <th>Giới tính</th>
                              <th>Ngày sinh</th>
                              <th>Nơi sinh</th>
                              <th>Dân tộc</th>
                              <th>Tên cha</th>
                              <th>Tên mẹ</th>
                              <th>Sửa</th>
                              @if(Auth::check())
                              @if(Auth::user()->level==0)
                              <th>Xóa</th>
                              @endif
                              @endif
                          </tr>
                      </thead>
                      <tbody id="hs-list" name="hs-list">
                      @isset($hocsinhs)
                      <?php $tt=1;?>
                      @foreach($hocsinhs as $hs)
                          <tr id="hs{{$hs->MaHS }}">
                              {{-- <td><?php echo $tt++; ?></td> --}}
                              <td>{{ $hs->MaHS }}</td>
                              <td>{{ $hs->MaLopHoc }}</td>
                              <td>{{ $hs->TenHS }}</td>
                              <td>{{ $hs->GioiTinh }}</td>
                              <td>{{ date('d-m-Y', strtotime($hs->NgaySinh)) }}</td>
                              <td>{{ $hs->noisinh }}</td>
                              <td>{{ $hs->dantoc }}</td>
                              <td>{{ $hs->hotencha }}</td>
                              <td>{{ $hs->hotenme  }}</td>
                              <td><button class="btn btn-info open-modal" value="{{$hs->MaHS}}">
                                    Sửa
                                  </button>
                              </td>
                              @if(Auth::check())
                              @if(Auth::user()->level==0)
                              <td><button class="btn btn-danger delete-hs" value="{{$hs->MaHS}}">
                                    Xóa
                                  </button>
                              </td>
                              @endif
                              @endif
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
{{-- Modal --}}
  <div class="modal fade " id="linkEditorModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="linkEditorModalLabel">Thông tin</h4>
            </div>
            <div class="modal-body">
                <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">

                    <div class="form-group" id="tt">
                        <label for="inputLink" class="col-sm-2 control-label">Mã học sinh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="MaHS" name="MaHS" placeholder="Nhập vào mã" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Lớp</label>
                        <div class="col-sm-10">
                            <select class="form-control MaLopHoc" id="MaLopHoc" name="MaLopHoc">
                              @foreach( $_SESSION['dslh'] as $lh)
                                  <option value='{{$lh->MaLopHoc}}'> {{$lh->Tenlophoc}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Họ tên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="TenHS" name="TenHS"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Giới tính</label>
                        <div class="col-sm-10">
                            <select class="form-control KhoiHoc" id="GioiTinh" name="GioiTinh">
                                <option value='Nam'> Nam</option>
                                <option value='Nữ'> Nữ</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Ngày sinh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="NgaySinh" name="NgaySinh"
                                   placeholder="Nhập ngày sinh" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nơi sinh</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="noisinh" name="noisinh"
                                   placeholder="Nhập nơi sinh" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dân tộc</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="dantoc" name="dantoc"
                                   placeholder="Nhập dân tộc" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Họ tên cha</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hotencha" name="hotencha"
                                   placeholder="Nhập vào tên cha" value="">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Họ tên mẹ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="hotenme" name="hotenme"
                                   placeholder="Nhập vào tên mẹ" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mật khẩu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="passwordhs" name="passwordhs"
                                   placeholder="Nhập mật khẩu" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="create">Lưu
                </button>
                <input type="hidden" id="hs_id" name="hs_id" value="0">
            </div>
        </div>
    </div>
  </div>
{{-- Modal --}}
 @push('scripts')
 <!-- Datatables -->
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
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    {{-- <script type="text/javascript">
      $(document).ready(function () {
         function khoiChanged(obj)
          {
              var value = obj.value;
              $('#khoi option[value='+value+']').attr('selected','selected');
              if (value === '10'){
                  window.location="/admin/hoc-sinh/10";
              }
              else if (value === '11'){
                  window.location="/admin/hoc-sinh/11";
              }
              else if (value === '12'){
                  window.location="/admin/hoc-sinh/12";
              }
          }
           function lopChanged(obj)
          {
              var value = obj.value;
              $('#lop option[value='+value+']').attr('selected','selected');
              window.location="/admin/hoc-sinh1/"+value;
          }
    </script> --}}
     <script type="text/javascript">
      $(document).ready(function($){
        $('#btn-add').click(function(){
          $('#tt').show();
          $('#btn-save').val('add');
          $('#modalFormData').trigger('reset');
          $('#linkEditorModal').modal('show');
        });
        $('body').on('click','.open-modal', function(){
            var id=$(this).val();
            $('#tt').hide();
            var url='{{url("/admin/hoc-sinh") }}'+'/'+id;
            $.get(url,function(data){
              $('#hs_id').val(data.MaHS);
              $('#TenHS').val(data.TenHS);
              $('#MaLopHoc option[value='+data.MaLopHoc+']').attr('selected','selected');
              $('#GioiTinh').val(data.GioiTinh);
              $('#NgaySinh').val(data.NgaySinh);
              $('#noisinh').val(data.noisinh);
              $('#dantoc').val(data.dantoc);
              $('#hotencha').val(data.hotencha);
              $('#hotenme').val(data.hotenme);
              $('#passwordhs').val(data.passwordhs);
              $('#btn-save').val('update');
              $('#linkEditorModal').modal('show');
            });
        });
        $('#btn-save').click(function(e){
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          e.preventDefault();
          var id=$('#hs_id').val();
          var MaHS= $('#MaHS').val();
          var MaLopHoc= $('#MaLopHoc').val();
          var TenHS= $('#TenHS').val();
          var GioiTinh= $('#GioiTinh').val();
          var NgaySinh= $('#NgaySinh').val();
          var noisinh= $('#noisinh').val();
          var dantoc= $('#dantoc').val();
          var hotencha= $('#hotencha').val();
          var hotenme= $('#hotenme').val();
          var passwordhs= $('#passwordhs').val();
          var state=$('#btn-save').val();
          var type = "POST";
          var url='{{url("/admin/hoc-sinh")}}';
          if (state=="update") {
            type ="PUT";
            url= '{{url("/admin/hoc-sinh") }}'+'/'+id;
          }
          $.ajax({
                type: type,
                url: url,
                data: {
                      MaHS: MaHS,
                      MaLopHoc: MaLopHoc,
                      TenHS: TenHS,
                      GioiTinh: GioiTinh,
                      NgaySinh: NgaySinh,
                      noisinh: noisinh,
                      dantoc: dantoc,
                      hotencha: hotencha,
                      hotenme: hotenme,
                      passwordhs: passwordhs,
                      },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var kq = '<tr id="hs' + data.MaHS + '"><td>' + data.MaHS + '</td><td>' + data.MaLopHoc + '</td><td>' + data.TenHS + '</td><td>' + data.GioiTinh + '</td><td>' + data.NgaySinh + '</td><td>' + data.noisinh + '</td><td>' + data.dantoc + '</td><td>' + data.hotencha + '</td><td>' + data.hotenme + '</td>';
                    kq += '<td><button class="btn btn-info open-modal" value="' + data.MaHS + '">Sửa</button></td>';
                    kq += '<td><button class="btn btn-danger delete-hs" value="' + data.MaHS + '">Xóa</button></td></tr>';
              if (state=="add") {
                $('#hs-list').append(kq);
              }
              else{
                $('#hs'+id).replaceWith(kq);
              }
              $('#modalFormData').trigger('reset');
              $('#linkEditorModal').modal('hide');
            },
            error: function(data) {
              console.log('Error',data);
            }
          });
        });     
        $(document).on('click', '.delete-hs', function(){
            var id=$(this).val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            url = '/admin/hoc-sinh/'+id;
            $.ajax({
              type : 'DELETE',
              url : url,
              dataType: 'json',
              success: function(data){
                console.log(data);
                $('#hs'+id).remove();
              },
              error: function(data){
                console.log('Error',data);
              }
            });
        });
      });
    </script>
@endpush
@endsection