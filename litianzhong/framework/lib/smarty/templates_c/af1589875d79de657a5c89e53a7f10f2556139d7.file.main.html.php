<?php /* Smarty version Smarty-3.1.19, created on 2015-09-01 04:21:26
         compiled from "E:\phpspace\chat\web\view\main.html" */ ?>
<?php /*%%SmartyHeaderCode:2884855e527c612bdf3-32687454%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af1589875d79de657a5c89e53a7f10f2556139d7' => 
    array (
      0 => 'E:\\phpspace\\chat\\web\\view\\main.html',
      1 => 1441074982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2884855e527c612bdf3-32687454',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'STATIC_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55e527c61ab1a3_41620532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e527c61ab1a3_41620532')) {function content_55e527c61ab1a3_41620532($_smarty_tpl) {?><!DOCTYPE html>
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
