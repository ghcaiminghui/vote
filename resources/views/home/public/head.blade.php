<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@section('csrf')
	@show
	<title>@yield('title')</title>
	<link rel="stylesheet" href="/home/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="/home/public/css/bootstrap-theme.min.css">
	@section('css')
    @show
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
			<a class="navbar-brand" href="/home/index/index">广东信达投票系统</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">快速投票菜单 <span class="caret"></span></a>
		              	<ul class="dropdown-menu">
							@foreach($ment as $row)
			                <li><a href="/home/voteinfo/index?id={{$row->id}}">{{$row -> title}}</a></li>
			                @endforeach
		              	</ul>
					</li>
					<li><a href="/home/voteresult/index">查看投票结果</a></li>
					<li><a href="/home/public/logout">退出</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	@section('main')
	@show
</body>
@section('javascript')
@show
</html>