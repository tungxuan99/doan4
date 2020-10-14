<!DOCTYPE html>
<html lang="en">
  <head>
    @include('layouts.admin.head')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/" class="site_title"><span>THPT Đa Phúc</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @include('layouts.admin.profile')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('layouts.admin.menu')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            @include('layouts.admin.menufooter')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('layouts.admin.menutop')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('layouts.admin.footer')
        <!-- /footer content -->
      </div>
    </div>
        @include('layouts.admin.js')
        @stack('scripts')
  </body>
</html>
