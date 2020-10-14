@extends('layouts.home.app')
@section('content')
	<div style="margin-top:20px;text-align: center;font-weight: bold;font-size: 25px;font-family: Tahoma ">TRA CỨU ĐIỂM</div>
	<div class="container">
		<div class="trai">
			<div class="wrap">
				<div class="avatar">
		      		<img src="../assets1/img/images/boss.png">
				</div>
				<form action="{{route('tradiem')}}" method="post">
					@csrf
					<input type="text" name="MaHS" placeholder="Tên tài khoản" required>
					<input type="password" name="passwordhs" placeholder="Mật Khẩu" required>
					<a href="" class="forgot_link">làm mới ?</a>
					<button><input type="submit" name="ok" value="Đăng Nhập" /></button>
				</form>
			</div>
		</div>
		<div class="phai">
			<div style="border: 1px solid #CDCDCD;background-color: #e4e0d8;width: 500px;font-family: Tahoma">
				<h6 style="font-weight: bold">Một số hướng dẫn cần thiết :</h6>
				<li>Đối tượng sử dụng : Học Sinh THPT Đa Phúc.</li>
				<li>Sinh viên đăng nhập vào hệ thống bằng mã số học sinh.</li>
				<li>Mật khẩu mặc định là mã số học sinh.</li>
				<li>Khi truy cập lần thứ nhất, học sinh lưu ý :</li>
				<h6>&nbsp &nbsp &nbsp &nbsp &nbsp - Phải thay đổi mật khẩu.</h6>
				<h6>&nbsp &nbsp &nbsp &nbsp &nbsp - Trong quá trình truy cập, nếu có thắc mắc gì hay quên</h6>
					<h6>&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp&nbsp&nbsp mật khẩu truy cập học sinh liên hệ nhà trường tạo qua</h6>
						<h6>&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspđịa chỉ email: quanlyhs@gmail.com.</h6>
			</div>
		</div>
		
	</div>
		
	<br/>
				
@endsection