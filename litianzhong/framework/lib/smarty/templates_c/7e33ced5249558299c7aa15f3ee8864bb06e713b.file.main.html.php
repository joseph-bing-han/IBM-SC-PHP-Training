<?php /* Smarty version Smarty-3.1.19, created on 2015-09-01 11:25:25
         compiled from "D:\workspace\chat\web\view\main.html" */ ?>
<?php /*%%SmartyHeaderCode:1649155e58b25bb3180-54960623%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e33ced5249558299c7aa15f3ee8864bb06e713b' => 
    array (
      0 => 'D:\\workspace\\chat\\web\\view\\main.html',
      1 => 1441086108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1649155e58b25bb3180-54960623',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'STATIC_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55e58b25c0d2b5_97272415',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e58b25c0d2b5_97272415')) {function content_55e58b25c0d2b5_97272415($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>聊天室</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="李天中">
</head>
<?php echo $_smarty_tpl->getSubTemplate ("include.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('backBtn'=>true,'reloadBtn'=>true), 0);?>

<script src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
resource/js/msg.js" type="text/javascript"></script>
<style type="text/css">
#msgs {
	min-height: 300px;
	height: 400px;
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
	overflow-y: auto;
	float: left;
	width: inherit
}

#msg {
	width: 78%;
}

#user {
	height: 500px;
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
#chathead{
   height:50px;
}
.chathead1{
float: left;
font-size: xx-large;
margin-top: 10px;
margin-left: 500px;
}
.chathead2{
float: right;
margin-top: 10px;
margin-right: 10px;
cursor:pointer;
}
.chathead3{
float: right;
margin-top: 10px;
margin-right: 130px;
cursor:pointer;
}
</style>
</head>
<body >
	<div class="container-fluid">
	    <div id="chathead">
	    <div class="chathead1">聊天室</div>
	    <div class="chathead3" id="btnOut">【退出】</div>
	    <div class="chathead2">【修改昵称】</div>

	    </div>
		<div class="row-fluid">
			<div class="span2" id="user"></div>
			<div class="span10">
				<div id="msgs"></div>
				<div>
					<input type="text" class="input-xxlarge search-query"
						placeholder="Type a message here" id="msg">
					<button type="button" class="btn  btn-primary" id="btnMsg">Send</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html><?php }} ?>
