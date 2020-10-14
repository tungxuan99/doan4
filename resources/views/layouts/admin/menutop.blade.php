<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="../assets1/img/images/boss.png" alt="">
            @if(Auth::check())
            {{Auth::user()->fullname}}
            @endif
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href=""> Thông tin</a></li>
            <li><a href="">Đổi mật khẩu</a></li>
            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green"></span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>