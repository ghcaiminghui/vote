<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>编辑主题</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>投票主题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text"  placeholder="请输入投票的标题" name="title" value="{{$vote -> title}}">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">投票简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="intro" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" >{{$vote -> intro}}</textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">投票类型：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="type" size="1">
					<option value="1" @if($vote->type == 1) selected="" @endif>单选投票</option>
					<option value="2" @if($vote->type == 2) selected="" @endif>多选投票</option>
					<option value="3" @if($vote->type == 3) selected="" @endif>星星评分</option>
				</select>
				</span> </div>
		</div>
		<div class="row cl limited">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>票量限制：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<input type="number" name="ticket_min" id="" placeholder="最少投几票" value="{{$vote -> ticket_min}}" class="input-text" style=" width:20%">
				<input type="number" name="ticket_max" id="" placeholder="最多投几票" value="{{$vote -> ticket_max}}" class="input-text" style=" width:20%">
			</div>
		</div>
		@foreach($option as $row)
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>投票侯选项：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="{{$row -> vote_name}}" placeholder="请输入候选人" name="vote_name{{$row->id}}">
			</div>
		</div>
		@endforeach
		<div class="row cl option">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary size-M radius addOption" type="button" value="添加候选人">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">投票说明：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="content" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" >{{$vote -> content}}</textarea>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>显示：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="status" type="radio" id="sex-1" @if($vote -> status == 2) checked @endif value="2">
					<label for="sex-3">是</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="sex-2" name="status" value="1" @if($vote -> status == 1) checked @endif >
					<label for="sex-2">否</label>
				</div>
			</div>
		</div>
		{{csrf_field()}}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.limited').hide();
	$('select[name=type]').change(function(){
	
		if($(this).val() == 2){

			$('.limited').show();
		}else{

			$('.limited').hide();
		}
	});

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			title:{
				required:true,
			},
			ticket_min:{
				required:true,
			},
			ticket_max:{
				required:true,
			},		
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit({
				type: 'post',
				url: "" ,
				success: function(data){

					if(data == '1'){

						layer.msg('添加成功!',{icon:1,time:2000},function(){

							var index = parent.layer.getFrameIndex(window.name);
							parent.$('.btn-refresh').click();
							parent.location.reload();
						});
					}else if(data == '2'){

						layer.msg('添加失败!',{icon:2,time:2000});
					}else{

						layer.msg('添加失败!',{icon:2,time:2000});
					}
					
				},
                error: function(XmlHttpRequest, textStatus, errorThrown){
					layer.msg('error!',{icon:1,time:1000});
				}
			});
		}
	});

	//点击添加文本框
    $('.addOption').click(function () {
        $('.option').before( 	'	<div class="row cl"><label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>投票侯选项：</label><div class="formControls col-xs-8 col-sm-9"><input type="text" class="input-text" value="" placeholder="请输入候选人" name="vote_name[]"></div></div> ' );
    });

});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>