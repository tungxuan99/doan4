@extends('layouts.home.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Điểm học sinh</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('quanlysinhviens.create') }}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" >
                            <thead>
                                <tr>
                                    <th>TT</th>
                                    <th>Môn học</th>
                                    <th>Điểm miệng</th>
                                    <th>Điểm 15p</th>
                                    <th>Điểm 1 tiết</th>
                                    <th>Điểm HK</th>
                                    <th>Điểm TB</th>
                                </tr>
                            </thead>
                            <tbody>
                            @isset($diems)
                            <?php $tt=1;?>
                            @foreach($diems as $diem)
                                <tr>
                                    <td><?php echo $tt++; ?></td>
                                    <td>{{ $diem->MaMonHoc }}</td>
                                    <td>{{ $diem->DiemMieng }}</td>
                                    <td>{{ $diem->Diem15Phut }}</td>
                                    <td>{{ $diem->Diem1Tiet }}</td>
                                    <td>{{ $diem->DiemHK }}</td>
                                    <td>{{ $diem->DiemTB }}</td>
                                </tr>
                            @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </div>
@endsection

