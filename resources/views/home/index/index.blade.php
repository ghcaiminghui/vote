@extends('home.public.head')
@section('title','广东信达投票系统')
@section('main')
	<!-- 中间部分 -->
	@foreach($ment as $row)
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
	<!-- 中间部分结束 -->
@endsection
