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

<title>添加候选人说明</title>
</head>
<body>
<article class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		@foreach($votelist as $row)
			@foreach($option as $val)
				@if($val->vote_id == $row -> id)
					<div class="row cl">
						<label class="form-label col-xs-4 col-sm-3">{{$row->title}}&nbsp;&nbsp;{{$val->vote_name}}：</label>
						<div class="formControls col-xs-8 col-sm-9">
							<textarea name="option_content{{$val->id}}" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符">{{$val -> option_content}}</textarea>
							<p class="textarea-numberbar"><em class="textarea-length">0</em>/250</p>
						</div>
					</div>
				@endif
			@endforeach
		@endforeach
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
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
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
        $('.option').after( 	'	<div class="row cl"><label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>投票侯选项：</label><div class="formControls col-xs-8 col-sm-9"><input type="text" class="input-text" value="" placeholder="请输入候选人" name="vote_name[]"></div></div> ' );
    });

    //点击添加换行
    $('.addbr').click(function(){

    	var content = $('textarea[name=content]').val();
    	$('textarea[name=content]').val(content + '<br>'); 
    });

});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>