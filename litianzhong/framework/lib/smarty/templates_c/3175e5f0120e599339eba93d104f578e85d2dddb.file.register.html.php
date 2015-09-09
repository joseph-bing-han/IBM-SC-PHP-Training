<?php /* Smarty version Smarty-3.1.19, created on 2015-09-01 02:08:08
         compiled from "E:\phpspace\chat\web\view\register.html" */ ?>
<?php /*%%SmartyHeaderCode:1004155e50888267166-90828881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3175e5f0120e599339eba93d104f578e85d2dddb' => 
    array (
      0 => 'E:\\phpspace\\chat\\web\\view\\register.html',
      1 => 1441073285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1004155e50888267166-90828881',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55e508882ac5b1_42344850',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e508882ac5b1_42344850')) {function content_55e508882ac5b1_42344850($_smarty_tpl) {?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>注册</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="李天中">
</head>
<?php echo $_smarty_tpl->getSubTemplate ("include.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('backBtn'=>true,'reloadBtn'=>true), 0);?>


<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.form-signin {
	max-width: 250px;
	padding: 19px 29px 29px;
	margin: 0 auto 20px;
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
}

.form-error {
	margin-top: 10px;
	font-size: smaller;
	color: red;
	display: none;
}

.form-signin .form-signin-heading, .form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin input[type="text"], .form-signin input[type="password"] {
	font-size: 16px;
	height: auto;
	margin-bottom: 15px;
	padding: 7px 9px;
}

h2 {
	text-align: center;
	color: darkgray;
}

a {
	color: darkgray;
}

.popWindow {
	background-color: #9D9D9D;
	width: 100%;
	height: 100%;
	left: 0;
	top: 0;
	filter: alpha(opacity = 50);
	opacity: 0.5;
	z-index: 1;
	position: absolute;
}
</style>
<script type="text/javascript">
$(function(){
	$("#userid").blur(function(){
		var id=$('#userid').val();
		 $.ajax({  
	         type:"POST", 
	         url:_request+"index.php/home/valId",  
	         dataType:"json",  
	         data:{id:id},  
	         success:function(data,textStatus){
	        	 if(data>0){
	        		alert("用户帐号重复！");
	        	 	$('#userid').val('');
	        	 	$('#userid').focus();
	        	 }
	         },
	         error: function(XMLHttpRequest,textStatus,errorThrown){   
	               alert("系统错误！");
	         }  
	     });  
	});
	$("#btnReg").click(function(){
		var id=$('#userid').val();
		var username=$('#username').val();
		var password=$('#userpwd').val();
		var password1=$('#userpwd1').val();
		$('#errorid').html("");
		if(id==""){
			$('#errorid').html("帐号不能为空");
			$('#errorid').show();
			return;
		}
		if(username==""){
			$('#errorid').html("昵称不能为空");
			$('#errorid').show();
			return;
		}
		if(password!=password1){
			$('#errorid').html("两次密码不一致！");
			$('#errorid').show();
			return;
		}
		 $.ajax({  
	         type:"POST", 
	         url:_request+"index.php/home/register",  
	         dataType:"json",  
	         data:{userid:id,username:username,password:password},  
	         success:function(data,textStatus){
	        	 if(data==true){
	        	 window.location.href=_request;
	         }else{
	        		$('#errorid').html("系统错误！");
	    			$('#errorid').show();
	         }
	         },
	         error: function(XMLHttpRequest,textStatus,errorThrown){   
	        	 alert("系统错误！");
	         }  
	     });  
	});
	
	
});
</script>
</head>
<body>
	<div class="container" id="main">

		<form class="form-signin" method="post">
			<h2 class="form-signin-heading">注册</h2>
			<input type="text" class=" input-block-level" placeholder="帐号"
				id="userid"> <input type="text" class="input-block-level"
				placeholder="昵称" id="username"> <input type="password"
				class="input-block-level" placeholder="密码" id="userpwd"> <input
				type="password" class="input-block-level" placeholder="确认密码"
				id="userpwd1">
			<button class="btn  btn-primary" type="button" id="btnReg">注册</button>

			<div id="errorid" class="form-error">dfdfsd</div>
		</form>
	</div>
</body>
</html>
<?php }} ?>
