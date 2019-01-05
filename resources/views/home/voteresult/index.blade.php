<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>广东信达投票系统</title>
	<link rel="stylesheet" href="/home/public/css/bootstrap.min.css">
	<link rel="stylesheet" href="/home/public/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/home/static/css/awesome-bootstrap-checkbox.css"/>
	<link rel="stylesheet" href="/home/static/css/bootstrap.css"/>
	<link rel="stylesheet" href="/home/static/Font-Awesome/css/font-awesome.min.css"/>
    <!-- <link rel="stylesheet" href="/home/static/css/build.css"/> -->
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
					<li><a href="/home/index/index">投票主题</a></li>
					<li class="active"><a href="/home/voteresult/index">查看投票结果</a></li>
					<li><a href="#contact">评论</a></li>
					<li><a href="#contact">退出</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	<!-- 中间部分 -->
	<div class="container theme-showcase " role="main">
		
		<!-- 投票主题 -->
		@foreach($vote as $row)
      	<div class="jumbotron">
      		<h1>{{$row -> title}}</h1>
      		<br><br>
      		
      		<!-- 候选人遍历 -->
      		@foreach($vote_option as $val)
      			@if($row -> id == $val -> vote_id)
					<p>
				        <span class="text-info">{{$val -> vote_name}}</span>
				        <div class="progress">
					  		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: @if($val -> total <= 3) 3% @else {{$val->total}}% @endif">
					    		<span>{{$val -> total}}票</span>
					  		</div>
						</div>
			        </p>
	        	@endif
	        @endforeach
	        <!-- 候选人遍历结束 -->

      	</div>
      	@endforeach
		<!-- 主题遍历结束 -->
	</div>
	<!-- 中间部分结束 -->
</body>
</html>