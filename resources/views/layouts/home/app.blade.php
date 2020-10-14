<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>TRƯỜNG THPT Đa Phúc </title>
    
    <link rel="shortcut icon" href="../assets1/img/logo.jpg" type="image/gif" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap styles -->
    <link href="../assets1/css/bootstrap.css" rel="stylesheet"/>
    <!-- Customize styles -->
    <link href="../assets1/style.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets1/css/css/style.css">
    <!-- font awesome styles -->
	<link href="../assets1/font-awesome/css/font-awesome.css" rel="stylesheet">

	<!-- Favicons -->
    <link rel="shortcut icon" href="../assets1/img/logo.jpg" >
  </head>
<body>
<!-- 
	Upper Header Section 
-->
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="topNav">
		<div class="container">
			<div class="alignR">
				 <div class="hcm" style="float:left">
                 <a target="_blank" href="http://daphuc.edu.vn/" style="font-size:28px"><span><font color="#CC0000">DAPHUC</font><font color="#000099">-EDU</font></span></a>
                 </div>
                 <a href="index.html" style="font-size:14px">Trang Chủ</a>
				<a href="{{route('login')}}" style="font-size:14px"><span class="icon-user"></span> Đăng Nhập </a>
				
				
			</div>
		</div>
	</div>
</div>

<!--
Lower Header Section 
-->
<div class="container">
<div id="gototop"> </div>
<header id="header">
<img src="../assets1/img/banner.png" alt="thpt đa phúc" height="144">
</header>

<!--
Navigation Bar Section 
-->
	<div class="container">
	  <div id="menu">
			<ul class="nav">
			  <li><a href="/homehs"> &nbsp;TRANG CHỦ	</a></li>
			  <li><a href="#">GIỚI THIỆU</a></li>
			  <li><a href="#">TIN TỨC</a></li>
                <li><a href="#">PHÒNG BAN</a></li>
			  <li><a href="{{route('diemhk')}}">XEM ĐIỂM</a></li>
			  <li><a href="#">KẾ HOẠCH</a></li>
              <li><a href="#">LIÊN HỆ</a></li>
			</ul>
	  </div>
</div>
 
<div class="container">
	@yield('content')
</div>
<!-- 
Clients 
-->
<section class="our_client">
	<hr class="soften"/>
<h4 class="title cntr"><span class="text"><marquee behavior="alternate" width="10%" direction="right">>></marquee>HIỀN TÀI LÀ NGUYÊN KHÍ CỦA QUỐC GIA<marquee behavior="alternate" width="10%"><< </marquee></span></h4>
	<hr class="soften"/>
	
</section>
<!--
Footer
-->
<footer class="footer">

</footer>
</div><!-- /container -->

{{-- <div class="copyright"> --}}
<div class="container">
  <div class="LogoBotoom" style='margin: 15px 20px 0; float:left' ><img src="../assets1/img/logo.jpg" style="height: 100px; width: 100px;" alt=" " /> </div>
  <div class="containe text-left" style="float:none">
  <br>
  <p><span><b>Trường Trung Học Phổ Thông Đa Phúc</b></span></p>
  <p><span><b>Địa Chỉ: Phố Giữa, Thị trấn Sóc Sơn, Huyện Sóc Sơn, TP Hà Nội</b><br>
  <p><span><b>Điện thoại: 024 3884 3430</b><br>
  </span></p>
  </div>
</div>
{{-- </div> --}}
<a href="#" class="gotop"><i class="icon-double-angle-up"></i></a>
    <script src="../assets1/js/jquery.js"></script>
	<script src="../assets1/js/bootstrap.min.js"></script>
	<script src="../assets1/js/jquery.easing-1.3.min.js"></script>
    <script src="../assets1/js/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script src="../assets1/js/shop.js"></script>
    
   	<script src="../assets1/js/dongho.js"></script>
   	<script src="../assets1/jquery-3.1.1.js"></script>
   
	
 </body>
</html>