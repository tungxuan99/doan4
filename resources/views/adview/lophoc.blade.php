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
                  <li><button class="btn btn-success" id="btn-add" name="btn-add">Thêm lớp</button></li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                               {{--  <th>TT</th> --}}
                                <th>Mã lớp học</th>
                                <th>Tên lớp học</th>
                                <th>Khối học</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody id="lh-list" name="lh-list">
                        @isset($lophocs)
                          {{-- <?php $tt=1;?> --}}
                          @foreach($lophocs as $lp)
                              <tr id="lp{{$lp->MaLopHoc }}"> 
                                  {{-- <td><?php echo $tt++; ?></td> --}}
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
                        <label for="inputLink" class="col-sm-2 control-label">Mã lớp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="MaLopHoc" name="MaLopHoc" placeholder="Nhập vào mã" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Tên lớp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Tenlophoc" name="Tenlophoc"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Khối học</label>
                        <div class="col-sm-10">
                            <select class="form-control KhoiHoc" id="KhoiHoc" name="KhoiHoc">
                                <option value='10'> Khối 10</option>
                                <option value='11'> Khối 11</option>
                                <option value='12'> Khối 12</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="create">Lưu
                </button>
                <input type="hidden" id="lp_id" name="lp_id" value="0">
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
            var url='{{url("/admin/lop-hoc") }}'+'/'+id;
            $.get(url,function(data){
              $('#lp_id').val(data.MaLopHoc);
              $('#Tenlophoc').val(data.Tenlophoc);
              $('#KhoiHoc option[value='+data.KhoiHoc+']').attr('selected','selected');
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
          var id=$('#lp_id').val();
          var MaLopHoc= $('#MaLopHoc').val();
          var Tenlophoc= $('#Tenlophoc').val();
          var KhoiHoc= $('#KhoiHoc').val();
          var state=$('#btn-save').val();
          var type = "POST";
          var url='{{url("/admin/lop-hoc")}}';
          if (state=="update") {
            type ="PUT";
            url= '{{url("/admin/lop-hoc") }}'+'/'+id;
          }
          $.ajax({
                type: type,
                url: url,
                data: {
                      MaLopHoc: MaLopHoc,
                      Tenlophoc: Tenlophoc,
                      KhoiHoc: KhoiHoc
                      },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var kq = '<tr id="lp' + data.MaLopHoc + '"><td>' + data.MaLopHoc + '</td><td>' + data.Tenlophoc + '</td><td>' + data.KhoiHoc + '</td>';
                    kq += '<td><button class="btn btn-info open-modal" value="' + data.MaLopHoc + '">Sửa</button></td>';
                    kq += '<td><button class="btn btn-danger delete-lp" value="' + data.MaLopHoc + '">Xóa</button></td></tr>';
              if (state=="add") {
                $('#lh-list').append(kq);
                $('#modalFormData').trigger('reset');
                $('#linkEditorModal').modal('hide');
                alert('Thêm lớp thành công!');
              }
              else{
                $('#lp'+id).replaceWith(kq);
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
        $(document).on('click', '.delete-lp', function(){
            var id=$(this).val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            url = '/admin/lop-hoc/'+id;
            $.ajax({
              type : 'DELETE',
              url : url,
              dataType: 'json',
              success: function(data){
                console.log(data);
                $('#lp'+id).remove();
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