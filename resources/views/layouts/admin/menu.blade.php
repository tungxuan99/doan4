<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>Quản lý</h3>
    <ul class="nav side-menu">
      @if(Auth::check())
      @if(Auth::user()->level==0 || Auth::user()->level==1)
      <li><a><i class="fa fa-child"></i> Học sinh <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('hocsinh.index')}}">Danh sách học sinh</a></li>
        </ul>
      </li>
      @endif
      @endif
      @if(Auth::check())
      @if(Auth::user()->level==0)
      <li><a><i class="fa fa-edit"></i> Môn học <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('monhoc.index')}}">Danh sách môn học</a></li>
        </ul>
      </li>
      @endif
      @endif
      @if(Auth::check())
      @if(Auth::user()->level==0 || Auth::user()->level==1)
      <li><a><i class="fa fa-desktop"></i> Lớp học<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('lophoc.index')}}">Danh sách lớp học</a></li>
        </ul>
      </li>
      @endif
      @endif
      @if(Auth::check())
      @if(Auth::user()->level==0)
      <li><a><i class="fa fa-male"></i> Giáo viên <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('giaovien.index')}}">Danh sách giáo viên</a></li>
        </ul>
      </li>
      @endif
      @endif
      @if(Auth::check())
      @if(Auth::user()->level==0 || Auth::user()->level==1)
      <li><a><i class="fa fa-bell-o"></i> Điểm danh <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('quanly.index')}}">Điểm danh</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-bookmark-o"></i> Điểm <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          @if(Auth::user()->level==1)
          <li><a href="{{route('quanly.diem')}}">Thêm điểm</a></li>
          @endif
          <li><a href="{{route('quanly.suadiem')}}">Sửa điểm</a></li>
          <li><a href="{{route('quanly.xemdiem')}}">Xem điểm</a></li>
          <li><a href="{{route('guidiem')}}">Gửi điểm</a></li>
        </ul>
      </li>
      @endif
      @endif
      @if(Auth::check())
      @if(Auth::user()->level==0)
      <li><a><i class="fa fa-clone"></i>Thống kê <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('thongke.top10')}}">Top điểm</a></li>
          <li><a href="#">Khen thưởng</a></li>
          <li><a href="#">Kỷ luật</a></li>
          <li><a href="{{route('thongke.diem')}}">Biểu đồ điểm</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-book"></i>In học bạ <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('dshocsinh')}}">Danh sách học sinh</a></li>
        </ul>
      </li>
      @endif
      @endif
      @if(Auth::check())
      @if(Auth::user()->level==2)
      <li><a><i class="fa fa-clone"></i>Điểm <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{route('diemhs')}}">Xem điểm</a></li>
        </ul>
      </li>
      @endif
      @endif
    </ul>
  </div>
</div>