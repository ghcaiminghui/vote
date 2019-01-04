<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>广东信达投票系统登录页</title>
<link rel="stylesheet" type="text/css" href="/home/css/normalize.css" />
<link rel="stylesheet" type="text/css" href="/home/css/demo.css" />
<!--必要样式-->
<link rel="stylesheet" type="text/css" href="/home/css/component.css" />
<!--[if IE]>
<script src="js/html5.js"></script>
<![endif]-->
</head>
<body>

		<div class="container demo-1">
			<div class="content">
				<div id="large-header" class="large-header">
					<canvas id="demo-canvas"></canvas>
					<div class="logo_box">
						<h3>广东信达投票系统</h3>
						<form id="biaodan1" action="/home/public/check" method="post">
							<div class="input_outer">
								<span class="u_user"></span>
								<input name="username" class="text" style="color: #FFFFFF !important" type="text" placeholder="请输入用户名">
							</div>
							<div class="input_outer">
								<span class="us_uer"></span>
								<input name="password" class="text" style="color: #FFFFFF !important; position:absolute; z-index:100;"value="" type="password" placeholder="请输入密码">
							</div>
							{{csrf_field()}}
							<div class="mb2">
                            <input name="login" type="hidden" >
                            <a class="act-but submit" href="javascript:;" style="color: #FFFFFF" onclick="document.getElementById('biaodan1').submit();">登录</a></div>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /container -->
		<script src="/home/js/TweenLite.min.js"></script>
		<script src="/home/js/EasePack.min.js"></script>
		<script src="/home/js/rAF.js"></script>
		<script src="/home/js/demo-1.js"></script>
		<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
		<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
		<script type="text/javascript">
   		$(function(){
   		
	     //显示错误信息
	    @if (count($errors) > 0)
	        var allError = '';
	            @foreach ($errors->all() as $error)
	                allError += "{{$error}}<br />";
	            @endforeach
	            layer.alert(allError,{title:'错误提示'});
	     @endif
    	});
</script>
</body>
</html>