@extends('layouts/admin/app')
@section('content')

<div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Quản lý giáo viên</h3>
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
                <h2>Danh sách giáo viên</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><button class="btn btn-success" id="btn-add" name="btn-add">Thêm giáo viên</button></li>
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
		                      <th>Mã GV</th>
		                      <th>Môn học</th>
		                      <th>Tên GV</th>
		                      <th>Địa chỉ</th>
		                      <th>SDT</th>
                          <th>Mật khẩu</th>
		                      <th>Edit</th>
		                      <th>Delete</th>
		                  </tr>
		              </thead>
		              <tbody id="gv-list" name='gv-list'>
		              @isset($giaoviens)
		                  <?php
		                      $tt=1; 
		                  ?>
		                  @foreach($giaoviens as $gv)
		                      <tr id="gv{{$gv->Magv }}">
		                          {{-- <td><?php echo $tt++; ?></td> --}}
		                          <td>{{ $gv->Magv }}</td>
		                          <td><?php foreach( $_SESSION['dsmh'] as $mh){
		                              if(($gv->MaMonHoc)==($mh->MaMonHoc))
		                              {
		                                  echo $mh->TenMonHoc;
		                                  break;
		                              }
		                          } ?></td>
		                          <td>{{ $gv->Tengv }}</td>
		                          <td>{{ $gv->DiaChi }}</td>
		                          <td>{{ $gv->SDT }}</td>
                              <td>{{ $gv->passwordgv }}</td>
		                          <td><button class="btn btn-primary open-modal" title="{{ "Sửa ".$gv->Tengv }}" value="{{$gv->Magv}}"><i class="fa fa-edit"></i></button>
		                          </td>
		                          <td><button class="btn btn-danger delete-gv" value="{{$gv->Magv}}" title="{{ "Xóa ".$gv->Tengv }}" ><i class="fa fa-trash"></i></button>
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
                        <label for="inputLink" class="col-sm-2 control-label">Mã giáo viên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Magv" name="Magv" placeholder="Nhập vào mã" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Tên giáo viên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Tengv" name="Tengv"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Môn học</label>
                        <div class="col-sm-10">
                            <select class="form-control MaMonHoc" id="MaMonHoc" name="MaMonHoc">
                              @foreach( $_SESSION['dsmh'] as $mh)
                                  <option value='{{$mh->MaMonHoc}}'> {{$mh->TenMonHoc}}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="DiaChi" name="DiaChi"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">SĐT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="SDT" name="SDT"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="inputLink" class="col-sm-2 control-label">Mật khẩu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="passwordgv" name="passwordgv"
                                   placeholder="Nhập vào tên" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-save" value="create">Lưu
                </button>
                <input type="hidden" id="gv_id" name="gv_id" value="0">
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
            var url='{{url("/admin/giao-vien") }}'+'/'+id;
            $.get(url,function(data){
              $('#gv_id').val(data.Magv);
              $('#Tengv').val(data.Tengv);
              $('#MaMonHoc option[value='+data.MaMonHoc+']').attr('selected','selected');
              $('#DiaChi').val(data.DiaChi);
              $('#SDT').val(data.SDT);
              $('#passwordgv').val(data.passwordgv);  
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
          var id=$('#gv_id').val();
          var Magv= $('#Magv').val();
          var Tengv= $('#Tengv').val();
          var MaMonHoc= $('#MaMonHoc').val();
          var DiaChi= $('#DiaChi').val();
          var SDT= $('#SDT').val();
          var passwordgv= $('#passwordgv').val();
          var state=$('#btn-save').val();
          var type = "POST";
          var url='{{url("/admin/giao-vien")}}';
          if (state=="update") {
            type ="PUT";
            url= '{{url("/admin/giao-vien") }}'+'/'+id;
          }
          $.ajax({
                type: type,
                url: url,
                data: {
                      Magv: Magv,
                      Tengv: Tengv,
                      MaMonHoc: MaMonHoc,
                      DiaChi: DiaChi,
                      SDT: SDT,
                      passwordgv: passwordgv
                      },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    var kq = '<tr id="gv' + data.Magv + '"><td>' + data.Magv + '</td><td>' + data.MaMonHoc + '</td><td>' + data.Tengv + '</td><td>' + data.DiaChi + '</td><td>' + data.SDT + '</td><td>' + data.passwordgv + '</td>';
                    kq += '<td><button class="btn btn-primary open-modal" value="' + data.Magv + '"><i class="fa fa-edit"></button></td>';
                    kq += '<td><button class="btn btn-danger delete-gv" value="' + data.Magv + '"><i class="fa fa-trash"></button></td></tr>';
              if (state=="add") {
                $('#gv-list').append(kq);
              }
              else{
                $('#gv'+id).replaceWith(kq);
              }
              $('#modalFormData').trigger('reset');
              $('#linkEditorModal').modal('hide');
            },
            error: function(data) {
              console.log('Error',data);
            }
          });
        });     
        $(document).on('click', '.delete-gv', function(){
            var id=$(this).val();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            url = '/admin/giao-vien/'+id;
            $.ajax({
              type : 'DELETE',
              url : url,
              dataType: 'json',
              success: function(data){
                console.log(data);
                $('#gv'+id).remove();
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