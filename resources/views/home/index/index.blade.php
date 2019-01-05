<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>广东信达投票系统</title>
	<link rel="stylesheet" href="/home/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="/home/public/css/bootstrap-theme.min.css">
	<!-- 自定义样式 -->
	<link rel="stylesheet" href="/home/public/css/theme.css">
	<script src="/home/public/js/jquery.min.js"></script>
	<script src="/home/public/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			<a class="navbar-brand" href="#">广东信达投票系统</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">投票主题</a></li>
					<li><a href="/home/voteresult/index">查看投票结果</a></li>
					<li><a href="#contact">评论</a></li>
					<li><a href="#contact">退出</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	<!-- 中间部分 -->
	@foreach($vote as $row)
	<div class="container theme-showcase" role="main">
		<!-- 第一个投票主题 -->
		<div class="jumbotron">
			<div class="container">
				<h1>{{$row -> title}}</h1>
				<p>{{$row -> intro}}</p>
				<p><a class="btn btn-lg btn-success" href="/home/voteinfo/index?id={{$row->id}}" role="button">查看详情</a></p>
			</div>
		</div>
	</div>
	@endforeach
</body>

</html>