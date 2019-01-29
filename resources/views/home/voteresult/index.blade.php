@extends('home.public.head')
@section('title','投票结果')
@section('main')
<!-- 中间部分 -->
<div class="container theme-showcase " role="main">
	
	<!-- 投票主题 -->
	@foreach($ment as $row)
  	<div class="jumbotron">
  		<h1>{{$row -> title}}</h1>
  		<br><br>
  		
  		<!-- 候选人遍历 -->
  		@foreach($vote_option as $val)
  			@if($row -> id == $val -> vote_id)
				<p>
			        <span class="text-info">{{$val -> vote_name}}</span>
			        <div class="progress">
			        	@if($row -> type != 3)
				  		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: @if($val -> total <= 6) 6% @else {{$val->total}}% @endif">
				    		<span>{{$val -> total}}票</span>
				  		</div>
				  		@else
				  		<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: @if($val -> total_points <= 6) 6% @else {{$val->total_points}}% @endif">
				    		<span>{{$val -> total_points}}分</span>
				  		</div>
				  		@endif
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
@endsection
