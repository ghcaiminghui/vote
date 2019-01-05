<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
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
					<li class="active"><a href="/home/index/index">投票主题</a></li>
					<li><a href="/home/voteresult/index">查看投票结果</a></li>
					<li><a href="#contact">评论</a></li>
					<li><a href="#contact">退出</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	
	<!-- 中间部分 -->
	<div class="container theme-showcase " role="main">
		
		<!-- 投票主题 -->
      	<div class="jumbotron">
	        <h1>{{$vote -> title}}</h1>
	        <p>{{$vote -> content}}</p>
      	</div>

      	
		<!-- 左边栏目 -->
      	<div class="col-lg-7 marketing">
      		@foreach($vote_option as $key => $row)
      	 		@if($key % 2 == 0)
					<h4>
						<div class="checkbox">
						<input type="checkbox" id="checkbox{{$row -> id}}" value="{{$row -> id}}">
						<label for="checkbox{{$row -> id}}">{{$row -> vote_name}}</label>
						</div>
					</h4>
          			<p>{{$row -> option_content}}</p>
				@endif
			@endforeach
        </div>
   
		<!-- 右边的栏目 -->
        <div class="col-lg-5 marketing">
      		@foreach($vote_option as $key => $row)
      	 		@if($key % 2 != 0)
					<h4>
						<div class="checkbox">
						<input type="checkbox" id="checkbox{{$row -> id}}" value="{{$row -> id}}">
						<label for="checkbox{{$row -> id}}">{{$row -> vote_name}}</label>
						</div>
					</h4>
          			<p>{{$row -> option_content}}</p>
				@endif
			@endforeach
        </div>

        <div class="clearfix"></div>

		@if($bool)
		<button type="button" class="btn btn-lg btn-success vote" disabled>已投票</button>
		@else
		<button type="button" class="btn btn-lg btn-success vote">投&nbsp;&nbsp;&nbsp;票</button>
		@endif

		<hr class="col-lg-12">
		
		<!-- 评论栏目 -->
		<div class="row Sender">
	        <div class="col-md-2 form-group">
	            <label>昵称：</label>
	            <input name="nickname" type="text" maxlength="12"  class="form-control">
			</div>
	        <div class="col-md-8 form-group">
	            <label>评论内容：</label>
	            <div class="input-group">
	                <input type="text" class="form-control" name="content">
	                <span class="input-group-btn"><input type="button" value="发表评论" class="btn btn-info comment"></span>
	            </div>
	        </div>
		
			<div class="clearfix"></div>

			<!-- 评论内容 -->
			<div class="col-md-10">
				<div class="CommentList">
					@if(!$comment)
					<div class="alert alert-warning" role="alert">
					<i class="fa fa-exclamation-triangle"></i>
					尚未有人发表评论，来发第一条吧！
					</div>
					@endif
				</div>
				<!-- 内容 -->
				<ul class="list-group">
					@foreach($comment as $row)
					<li class="list-group-item ucontent"><span  class="text-info">{{$row -> nickname}}</span>：{{$row -> content}}</li>
					@endforeach
				</ul>
			</div>
			<!-- 评论内容结束 -->

		</div>
		<!-- 评论栏目结束 -->
	</div>
	<!-- 中间部分结束 -->
</body>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script>
	$(function(){

		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		var optionMin = "{{$vote -> ticket_min}}";
		var optionMax = "{{$vote -> ticket_max}}";
		var num = 0;
		var val = [];

		$('.vote').click(function(){
			//循环checkbox框
			$('input[type="checkbox"]').each(function(index, domEle){
				//判断checked是否被选中
				if( $(this).attr('checked') ){

					num += 1;
					val.push($(this).val());
				}

			});

			//判断是否大于或者小于限定值
			if(num >= optionMin && num <= optionMax){

				$(this).html('已投票').attr('disabled',true);
				
				$.post('/home/voteinfo/check',{'val':val,vote_id:"{{$vote -> id}}",'uid':"{{session('id')}}"},function(data){

					if(data.msg == '2'){

						layer.alert('投票失败,该主题你已投票');
					}else if(data.msg == '1'){

						layer.alert('投票成功');
					}else if(data.msg == '4'){

						layer.alert('投票失败,投票数不能小于' + optionMin + '票或大于' + optionMax + '票.' );
					}else{

						layer.alert('非法操作' );
					}
				});

			}else{
				num = 0;
				val = [];
				layer.alert('投票失败,投票数不能小于' + optionMin + '票或大于' + optionMax + '票.' );
			}
		}); 

		//点击发表评论
		$('.comment').click(function(){

			var nickname = $('input[name=nickname]').val();
			var content = $('input[name=content]').val();
			
			if(nickname == '' || content == ''){

				layer.alert('您好！昵称和内容不能为空');
				
			}else{

				$.post('/home/comment/create',{nickname:nickname,content:content,'user_id':"{{session('id')}}",'vote_id':"{{$vote -> id}}"},function(data){

					if( data == '1'){

						layer.alert('发表成功');
						$('input[name=nickname]').val('');
						$('input[name=content]').val('');
						$('.ucontent').last().after('<li class="list-group-item ucontent"><span  class="text-info">'+ nickname +'</span>：'+ content +'</li>')
					}else if( data == '2'){

						layer.alert('评论失败,请刷新浏览器再试！！');
					}
				});
			}

		});

	});
</script>
</html>