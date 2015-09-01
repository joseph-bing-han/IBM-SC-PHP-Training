<?php /* Smarty version Smarty-3.1.19, created on 2015-06-25 03:56:57
         compiled from "C:\xampp\htdocs\mylogin\web\view\login.html" */ ?>
<?php /*%%SmartyHeaderCode:32696558b5fe9276673-80185380%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '673c01e52604f184392115f7cd7ccba91de6fe17' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mylogin\\web\\view\\login.html',
      1 => 1435121219,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32696558b5fe9276673-80185380',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'STATIC_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_558b5fe92a9303_56839415',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_558b5fe92a9303_56839415')) {function content_558b5fe92a9303_56839415($_smarty_tpl) {?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title>系统登录</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="李天中">
</head>
<link class="bootstrap library" rel="stylesheet" type="text/css"
	href="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
plugins/bootstrap/css/bootstrap.min.css">
<script class="bootstrap library"
	src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
plugins/jquery/jquery-1.11.0.min.js"
	type="text/javascript"></script>
<script class="bootstrap library"
	src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
plugins/bootstrap/js/bootstrap.min.js"
	type="text/javascript"></script>
<script 
	src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
plugins/backbone/underscore-min.js"
	type="text/javascript"></script>
<script 
	src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
plugins/backbone/backbone-min.js"
	type="text/javascript"></script>
<script 
	src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
resource/js/login.js"
	type="text/javascript"></script>
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
	display:none;
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
h2{
	text-align:center;
	color: darkgray;
}
a{
	color: darkgray;
}
</style>
</head>
<body>
	<div class="container" id="main">

		<form class="form-signin">
			<h2 class="form-signin-heading">登录</h2>
			<input type="text" class="input-block-level"placeholder="用户名" id="username" >
			<input type="password" class="input-block-level" placeholder="密码" id="userpwd"> 
			<button class="btn  btn-primary" type="button" id="btnLogin" >现在登录</button>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a href="#">忘记登录密码？</a>
			<div id="errorid" class="form-error"></div>
		</form>
	</div>
</body>
</html>
<?php }} ?>
