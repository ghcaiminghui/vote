@extends('home.public.head')


@section('csrf')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('title','投票详情')


@section('css')
	<!-- <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/xingxing.css"> -->
	<style type="text/css">
		.star-bar-show{background:url(/admin/static/h-ui/images/star/iconpic-star-S-default.png) repeat-x 0 0}
		.star-bar-show .star{background:url(/admin/static/h-ui/images/star/iconpic-star-S.png) repeat-x 0 0}
		.star-1{width:20%}
		.star-2{ width:40%}
		.star-3{width:60%}
		.star-4{ width:80%}
		.star-5{ width:100%}
		.star-bar-show.size-M{width:120px;height:24px}
		.star-bar-show.size-M,.star-bar-show.size-M .star{background-size:24px}
		.star-bar-show.size-M .star{ height:24px}
		.star-bar-show.size-S{width:80px; height:16px}
		.star-bar-show.size-S,.star-bar-show.size-S .star{background-size:16px}
		.star-bar-show.size-S .star{ height:16px}
	</style>
@endsection


@section('main')
	<!-- 模态框 -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
	<!-- 模态框结束 -->

	<!-- 中间部分 -->
	<div class="container theme-showcase " role="main">
		
		<!-- 投票主题 -->
      	<div class="jumbotron">
	        <h1>{{$vote -> title}}</h1>
	        <p>{!!$vote -> content!!}</p>
      	</div>

      	
		<!-- 左边栏目 -->
      	<div class="col-lg-6 marketing">
      		@foreach($vote_option as $key => $row)
      			@if($key % 2 == 0)
	      		<h4>	
		      		<div>
						<span class="f-l f-15 va-m pull-left">{{$row -> vote_name}}：</span>
						<div id="star-{{$row->id}}" class="pull-left "></div>
						&nbsp;&nbsp;&nbsp;&nbsp;<strong id="{{$row->id}}" class="f-l va-m">5分</strong>
					</div>
				</h4>
				<p>{{$row -> option_content}}</p>
				@endif
			@endforeach
        </div>

		<!-- 右边的栏目 -->
      	<div class="col-lg-6 marketing">
      		@foreach($vote_option as $key => $row)
      			@if($key % 2 != 0)
	      		<h4>	
		      		<div>
						<span class="pull-left f-l f-15 va-m">{{$row -> vote_name}}：</span>
						<div id="star-{{$row->id}}" class="pull-left"></div>
						&nbsp;&nbsp;&nbsp;&nbsp;<strong id="{{$row->id}}" class="f-l va-m select">5分</strong>
					</div>
				</h4>
				<p>{{$row -> option_content}}</p>
				@endif
			@endforeach
        </div>

        <div class="clearfix"></div>

		@if($bool)
		<button type="button" class="btn btn-lg btn-success vote" disabled>已评分</button>
		@else
		<button type="button" class="btn btn-lg btn-success vote">评&nbsp;&nbsp;&nbsp;分</button>
		@endif

		@if($nextId)
		&nbsp;&nbsp;&nbsp;<a href="/home/voteinfo/index?id={{$nextId}}" type="button" class="btn btn-lg btn-success">下一页</a>
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
					<li class="ucontent" style="list-style: none;"></li>
					@foreach($comment as $row)
					<li class="list-group-item ucontent"><span  class="text-info">{{$row['nickname']}}</span>：{{$row['content']}}</li>
					@endforeach
				</ul>
			</div>
			<!-- 评论内容结束 -->

		</div>
		<!-- 评论栏目结束 -->
	</div>
	<!-- 中间部分结束 -->
@endsection


@section('javascript')
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script>
<script>
	$(function(){

		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		var optionMin = "{{$vote -> ticket_min}}";
		var optionMax = "{{$vote -> ticket_max}}";
		var num = 0;
		var val = [];

		//model
		$('span[name=model]').click(function(){

			var id = $(this).attr('for').substring(8);
			var label = $(this);
			$.get('/home/voteinfo/model',{id:id},function(data){

				if(data.msg != null){
								
					$('#myModalLabel').html(data.title);
					$('.modal-body').html(data.msg);
					$('#myModal').modal('show');
				}
			},'json');

		});

		
		//stop_vote
		@if($vote -> status == '2')
			var arr=[];
			var jian=[];
			$('.vote').click(function(){

				$('strong').each(function(i,n){

					var id = parseInt($(this).html());
					arr.push(id);
					jian.push(n.id);

				});

				$.post('/home/voteinfo/checkXing',{arr:arr,jian:jian,uid:"{{session('id')}}",vote_id:'{{$vote->id}}'},function(data){

					if(data.msg == 2){

						layer.alert('您已经评分了,无法重复评分');
					}else if(data.msg == 1){

						layer.alert('成功评分');
						$('.vote').attr('disabled',true).html('已评分');

					}else{

						layer.alert('系统出错,刷新试试！！');
					}
				});
			});


		@else
		$('.vote').html('很抱歉活动已停止').attr('disabled',true);
		@endif

		//点击发表评论
		$('.comment').click(function(){

			var nickname = $('input[name=nickname]').val();
			var content = $('input[name=content]').val();
			
			if(nickname == '' || content == ''){

				layer.alert('您好！昵称和内容不能为空');
				
			}else{

				$.post('/home/comment/create',{nickname:nickname,content:content,user_id:"{{session('id')}}",'vote_id':"{{$vote -> id}}"},function(data){

					if( data == '1'){

						layer.alert('发表成功');
						$('input[name=nickname]').val('');
						$('input[name=content]').val('');
						@if(!$comment)
						$('.CommentList').empty();
						@endif
						$('.ucontent').last().after('<li class="list-group-item ucontent"><span  class="text-info">'+ nickname +'</span>：'+ content +'</li>');
					}else if( data == '2'){

						layer.alert('评论失败,请刷新浏览器再试！！');
					}
				});
			}
		});

		@foreach($vote_option as $row)
		$("#star-{{$row->id}}").raty({
			hints: ['1','2', '3', '4', '5'],//自定义分数
			starOff: 'iconpic-star-S-default.png',//默认灰色星星
			starOn: 'iconpic-star-S.png',//黄色星星
			path: '/admin/static/h-ui/images/star/',//可以是相对路径
			number: 5,//星星数量，要和hints数组对应
			showHalf: true,
			score:5,
			targetKeep : true,
			click: function (score, evt) {//点击事件
				//第一种方式：直接取值
				$("#{{$row->id}}").html(score+'分');
			}
		});
		@endforeach

	});
</script>
@endsection