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
					<li><a href="#">投票主题</a></li>
					<li><a href="#about">查看投票结果</a></li>
					<li><a href="#contact">评论</a></li>
					<li><a href="#contact">退出</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	<!-- 中间部分 -->
	<div class="container theme-showcase" role="main">
		
		<!-- 投票主题 -->
      	<div class="jumbotron">
	        <h1>底稿制作优秀项目</h1>
	        <p>(1) 认真遵守内核制度中关于工作底稿的相关要求；<br>
				(2) 能按时、按规则，有序、有质量地整理、提供、落实项目工作底稿; <br>
				(3) 在项目工作底稿文件及目录的提供、底稿标签的标注、底稿文件的齐全与有效性方面，基本上能一次成型；对需要后继需要补充的工作底稿也能及时补充并有效率地落实。</p>
      	</div>
		<form role="form">
			多选效果
			<div class="checkbox">
				<input type="checkbox" id="checkbox1">
				<label for="checkbox1">
				Check me out
				</label>
			</div>
			...
		</form> 
		<form role="form">
			单选效果
			<div class="radio">
				<input type="radio" name="radio2" id="radio3" value="option1">
				<label for="radio3">
				  One
				</label>
			</div>
			<div class="radio">
				<input type="radio" name="radio2" id="radio4" value="option2" checked>
				<label for="radio4">
				  Two
				</label>
			</div>
			...
		</form> 

	</div>
	
</body>

</html>