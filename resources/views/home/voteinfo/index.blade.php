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
	<style>
		/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 48px;
}
.vote{
 margin-left: 10px;
}
	</style>

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
					<li><a href="#about">查看投票结果</a></li>
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
	        <h1>底稿制作优秀项目</h1>
	        <p>(1) 认真遵守内核制度中关于工作底稿的相关要求；<br>
				(2) 能按时、按规则，有序、有质量地整理、提供、落实项目工作底稿; <br>
				(3) 在项目工作底稿文件及目录的提供、底稿标签的标注、底稿文件的齐全与有效性方面，基本上能一次成型；对需要后继需要补充的工作底稿也能及时补充并有效率地落实。</p>
      	</div>

      	<div class="col-lg-7 marketing">
			<h4>
				<div class="checkbox">
				<input type="checkbox" id="checkbox1">
				<label for="checkbox1">林璐</label>
				</div>
			</h4>
          	<p>这是一条个人说明，你的竞选理由</p>

	        <h4>
				<div class="checkbox">
				<input type="checkbox" id="checkbox2">
				<label for="checkbox2">李晓茵</label>
				</div>
			</h4>
          	<p>这是一条个人说明，你的竞选理由</p>

	        <h4>
				<div class="checkbox">
				<input type="checkbox" id="checkbox3">
				<label for="checkbox3">林思如</label>
				</div>
			</h4>
          	<p>这是一条个人说明，你的竞选理由</p>
        </div>
		
		<!-- 右边的栏目 -->
        <div class="col-lg-5 marketing">
			<h4>
				<div class="checkbox">
				<input type="checkbox" id="checkbox4">
				<label for="checkbox4">林璐</label>
				</div>
			</h4>
          	<p>这是一条个人说明，你的竞选理由</p>

	        <h4>
				<div class="checkbox">
				<input type="checkbox" id="checkbox5">
				<label for="checkbox5">李晓茵</label>
				</div>
			</h4>
          	<p>这是一条个人说明，你的竞选理由</p>

	        <h4>
				<div class="checkbox">
				<input type="checkbox" id="checkbox6">
				<label for="checkbox6">林思如</label>
				</div>
			</h4>
          	<p>这是一条个人说明，你的竞选理由</p>

        </div>
		<button type="button" class="btn btn-lg btn-success vote">投&nbsp;&nbsp;票</button>
		<hr class="col-lg-12">

		<!-- 评论栏目 -->
<!-- 		<div class="form-group has-success col-xs-6">
			<label class="control-label" for="inputSuccess1">评论内容</label>
			<input type="text" class="form-control" id="inputSuccess1" aria-describedby="helpBlock2">
		</div>
		<div class="form-group has-success col-xs-2">
			<label class="control-label" for="inputSuccess1">&nbsp;</label>
			<button type="button" class="btn btn-success form-control">发表匿名评论</button>
		</div>
		<div class="row"> -->

		<div id="cphMainContent_ucComment_pnlCommentSender" class="row Sender">
        <div id="cphMainContent_ucComment_pnlCommentNicknameInput" class="col-md-2 form-group">
				
            <label>昵称：</label>
            <input name="ctl00$cphMainContent$ucComment$tbNickname" type="text" maxlength="12" id="tbNickname" class="form-control NicknameInput">
        
			</div>
        <div class="col-md-8 form-group CommentEditorWrapper">
            <label>评论内容：</label>
            <div class="input-group">
                <input id="tbCommentContent" type="text" class="form-control CommentInput">
                <span class="input-group-addon"><a href="javascript:;" class="MoodSelectButton"><i class="fa fa-smile-o"></i></a></span>
                <span class="input-group-btn">
                    <input id="btnPostComment" type="button" value="发表评论" class="btn btn-info ButtonPostComment"></span>
            </div>
        </div>

		<!-- 评论栏目结束 -->
		<div class="clearfix"></div>
		<!-- 评论内容 -->
		<div class="col-md-10">
			<ul class="list-group">
				<li class="list-group-item">Cras justo odio</li>
				<li class="list-group-item">Dapibus ac facilisis in</li>
				<li class="list-group-item">Morbi leo risus</li>
				<li class="list-group-item">Porta ac consectetur ac</li>
				<li class="list-group-item">Vestibulum at eros</li>
			</ul>
		</div>
		<!-- 评论内容结束 -->


	</div>



	
	
</body>

</html>