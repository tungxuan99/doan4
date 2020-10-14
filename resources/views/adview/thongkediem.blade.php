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
                
                <form action="{{route('thongke.diem')}}" method="post" accept-charset="utf-8">
                  @csrf
                  <div class="form-group row">
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Chọn kỳ</label>
                    <div class="col-md-8">
                      <select name="Ky" class="form-control">
                        <option value="1">Kỳ 1</option>
                        <option value="2">Kỳ 2</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Năm học</label>
                    <div class="col-md-8">
                      <select name="NamHoc" class="form-control">
                        <option value="2019">2019-2020</option>
                        <option value="2018">2018-2019</option>
                        <option value="2017">2017-2018</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label class="col-md-4 col-form-label">Chọn môn</label>
                    <div class="col-md-8">
                      <select name="MonHoc" class="form-control">
                        @foreach($monhocs as $mh)
                        <option value="{{$mh->MaMonHoc}}">{{$mh->TenMonHoc}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                
                  <div class="col-md-2">
                    <button type="submit" class="btn btn-info">Gửi</button>
                  </div>
                </div>
                </form>
                @isset($mon)
                <h2>Biểu đồ điểm môn {{$mon}}</h2>
                @endisset
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                @isset($diem)
                  <div id="container" data-diem="{{ $diem }}"></div>
                @endisset
              </div>
            </div>
          </div>
        </div>
    </div>
 @push('scripts')
  <script type="text/javascript">
    $(document).ready(function(){
    var diem = $('#container').data('diem');
    var listOfValue = [];
    var listOfLop = [];
    diem.forEach(function(element){
        listOfLop.push(element.MaLopHoc);
        listOfValue.push(element.value);
    });
    console.log(listOfValue);
    var chart = Highcharts.chart('container', {

        title: {
            text: 'Điểm trung bình'
        },

        subtitle: {
            text: 'Plain'
        },

        xAxis: {
            categories: listOfLop,
        },

        series: [{
            type: 'column',
            colorByPoint: true,
            data: listOfValue,
            showInLegend: false
        }]
    });
    
    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });
});
  </script>
 @endpush
@endsection