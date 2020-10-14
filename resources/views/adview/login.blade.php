<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="../assets1/img/logo.jpg">

  <title>Đa Phúc Admin</title>
  <!-- Bootstrap -->
  <!-- Bootstrap CSS -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="../css/bootstrap-theme.css" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->
  <link href="../css/elegant-icons-style.css" rel="stylesheet" />
  <link href="../css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles -->
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style-responsive.css" rel="stylesheet" />
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" action="{{ route('login')}}" method="post">
      @csrf
      <div class="login-wrap">
        <p class="login-img"><i class="icon_lock_alt"></i></p>
        @if(Session::has('flag'))
        <div class="alert alert-{{Session::get('flag')}}">
          {{Session::get('message')}}
        </div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
          @foreach($errors->all() as $err)
            <li>{{$err}}</li>
          @endforeach
        </div>
        @endif
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_profile"></i></span>
          <input type="text" name="username" id="username" class="form-control" placeholder="tên đăng nhập" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><i class="icon_key_alt"></i></span>
          <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
        </div>
        <label class="checkbox">
                <input type="checkbox" value="remember-me"> Ghi nhớ
                <span class="pull-right"> <a href="#"> Quên mật khẩu?</a></span>
            </label>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Đăng nhập</button>
        <a class="btn btn-info btn-lg btn-block" href="{{ route('dangky')}}">Đăng ký</a>
      </div>
    </form>
    <div class="text-right">
      <div class="credits">
          {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
        </div>
    </div>
  </div>


</body>

</html>
