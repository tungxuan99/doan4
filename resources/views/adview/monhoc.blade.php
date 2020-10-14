@extends('layouts/admin/app')
@section('content')
	
	<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Quản lý môn học</h3>
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
                  <li><button class="btn btn-success" id="btn-add" name="btn-add">Thêm môn</button></li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped" >
                      <thead>
                          <tr>
                              {{-- <th>TT</th> --}}
                              <th>Mã môn học</th>
                              <th>Tên môn học</th>
                              <th>Số tiết</th>
                              <th>Hệ số</th>
                              <th>Sửa</th>
                              <th>Xóa</th>
                          </tr>
                      </thead>
                      <tbody id="mh-list" name="mh-list">
                      @isset($monhocs)
                      <?php $tt=1;?>
                      @foreach($monhocs as $mh)
                          <tr id="mh{{$mh->MaMonHoc }}">
                              {{-- <td><?php echo $tt++; ?></td> --}}
                              <td>{{ $mh->MaMonHoc }}</td>
                              <td>{{ $mh->TenMonHoc }}</td>
                              <td>{{ $mh->SoTiet }}</td>
                              <td>{{ $mh->HeSoMonHoc }}</td>
                              <td><button class="btn btn-info open-modal" value="{{$mh->MaMonHoc}}">
                                  Sửa
                                </button>
                              </td>
                              <td><button class="btn btn-danger delete-mh" value="{{$mh->MaMonHoc}}">
                                    Xóa
                                  </button>
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
                        <label for="inputLink" class="col-sm-2 control-label">Mã môn học</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="MaMonHoc" name="MaMonHoc" placeholder="Nhập vào mã" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Tên môn học</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="TenMonHoc" name="TenMonHoc"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Số tiết</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" class="form-control" id="SoTiet" name="SoTiet"
                                   placeholder="Nhập vào số tiết" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Hệ số</label>
                        <div class="col-sm-10">
                            <input type="number" min="0" max="9" class="form-control" id="HeSoMonHoc" name="HeSoMonHoc"
                                   placeholder="Nhập vào hệ số" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="create">Lưu
                </button>
                <input type="hidden" id="mh_id" name="mh_id" value="0">
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
            var url='{{url("/admin/mon-hoc") }}'+'/'+id;
            $.get(url,function(data){
              $('#mh_id').val(data.MaMonHoc);
              $('#TenMonHoc').val(data.TenMonHoc);
              $('#SoTiet').val(data.SoTiet);
              $('#HeSoMonHoc').val(data.HeSoMonHoc);
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
          var id=$('#mh_id').val();
          var MaMonHoc= $('#MaMonHoc').val();
          var TenMonHoc= $('#TenMonHoc').val();
          var SoTiet= $('#SoTiet').val();
          var HeSoMonHoc= $('#HeSoMonHoc').val();
          var state=$('#btn-save').val();
          var type = "POST";
          var url='{{url("/admin/mon-hoc")}}';
          if (state=="update") {
            type ="PUT";
            url= '{{url("/admin/mon-hoc") }}'+'/'+id;
          }
          $.ajax({
                type: type,
                url: url,
                data: {
                      MaMonHoc: MaMonHoc,
                      TenMonHoc: TenMonHoc,
                      SoTiet: SoTiet,
                      HeSoMonHoc: HeSoMonHoc
                      },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var kq = '<tr id="mh' + data.MaMonHoc + '"><td>' + data.MaMonHoc + '</td><td>' + data.TenMonHoc + '</td><td>' + data.SoTiet + '</td><td>' + data.HeSoMonHoc + '</td>';
                    kq += '<td><button class="btn btn-info open-modal" value="' + data.MaMonHoc + '">Sửa</button></td>';
                    kq += '<td><button class="btn btn-danger delete-mh" value="' + data.MaMonHoc + '">Xóa</button></td></tr>';
              if (state=="add") {
                $('#mh-list').append(kq);
                $('#modalFormData').trigger('reset');
                $('#linkEditorModal').modal('hide');
                alert('Thêm môn học thành công!');
              }
              else{
                $('#mh'+id).replaceWith(kq);
                $('#modalFormData').trigger('reset');
                $('#linkEditorModal').modal('hide');
                alert('Sửa thông tin thành công!');
              }
              
            },
            error: function(data) {
              console.log('Error',data);
            }
          });
        });     
        $(document).on('click', '.delete-mh', function(){
            var id=$(this).val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            url = '/admin/mon-hoc/'+id;
            $.ajax({
              type : 'DELETE',
              url : url,
              dataType: 'json',
              success: function(data){
                console.log(data);
                $('#mh'+id).remove();
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