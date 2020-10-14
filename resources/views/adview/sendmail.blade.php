<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Send mail</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->

	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>
<body>
	<div class="container mt-5 md-4">
		
		<h3>Send mail</h3>
		<form action="{{route('sendmail')}}" method="post" accept-charset="utf-8">
			@csrf
			<div class="row">
				<span>To</span>
				<input type="text" name="to" placeholder="">
			</div>
			<div class="row">
				<span>Title</span>
				<input type="text" name="title" placeholder="">
				<span>Body</span>
				<textarea name="body"></textarea>
			</div>
			<button type="submit" class="btn btn-success">Send</button>
		</form>
	</div>
</body>
</html>