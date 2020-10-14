@extends('layouts.home.app')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Xem điểm thi học kỳ</h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="clearfix"></div>
                <form action="{{route('diemhk')}}" method="post" accept-charset="utf-8">
                    @csrf
                    <h3>Tìm kiếm :</h3> <input  type="text" size="80" name="string" placeholder="Nhập mã học sinh hoặc tên học sinh" value="" ><br>
                    <button class="btn btn-success" type="submit">Tìm</button>
                </form>
                @if(Session::has('message'))
                <div class="alert alert-danger">
                  {{Session::get('message')}}
                </div>
                @endif
                @isset($diems)
                    <div class="table-responsive">
                        <table class="table table-bordered" style="background-color: #ffeeba" >
                            <thead style="background-color: #d9edf7" >
                                <tr >
                                    <th>TT</th>
                                    <th>Mã học sinh</th>
                                    <th>Tên học sinh</th>
                                    <th>Ngày sinh</th>
                                    @foreach($dsmh as $mh)
                                    <th>{{$mh->TenMonHoc}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            @isset($hocsinhs)
                                <?php $tt=1; ?>
                                  @foreach($hocsinhs as $hs)
                                      <tr> 
                                          <td><?php echo $tt++; ?></td>
                                          <td>{{ $hs->MaHS }}</td>
                                          <td>{{ $hs->TenHS }}</td>
                                          <td>{{ $hs->NgaySinh }}</td>
                                          <?php
                                            if(count($diems)>0){
                                                foreach($diems as $diem){
                                                    if($diem['MaHS']==$hs->MaHS){
                                                        echo "<td>".$diem['DiemHK']."</td>";
                                                    }
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
@endsection

