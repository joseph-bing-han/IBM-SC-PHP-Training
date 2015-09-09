<?php /* Smarty version Smarty-3.1.19, created on 2015-08-28 12:06:37
         compiled from "D:\workspace\mylogin\web\view\main.html" */ ?>
<?php /*%%SmartyHeaderCode:2308255e04ecd25e379-22420781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec1866f57871e52f005499f2fb929134a0c7ae5c' => 
    array (
      0 => 'D:\\workspace\\mylogin\\web\\view\\main.html',
      1 => 1440760141,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2308255e04ecd25e379-22420781',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'STATIC_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_55e04ecd2b8e53_58724381',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55e04ecd2b8e53_58724381')) {function content_55e04ecd2b8e53_58724381($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>系统登录</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="李天中">
</head>
<?php echo $_smarty_tpl->getSubTemplate ("include.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('backBtn'=>true,'reloadBtn'=>true), 0);?>

<script 
	src="<?php echo $_smarty_tpl->tpl_vars['STATIC_URL']->value;?>
resource/js/msg.js"
	type="text/javascript"></script>
<style type="text/css">
#msgs {
	min-height: 300px;
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
</style>
</head>
<body>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
    </div>
    <div class="span10">
      <div id="msgs">
      </div>
      <div >
      	 <input type="text" class="input-xxlarge search-query" placeholder="Type a message here" id="msg">
  		 <button type="button" class="btn  btn-primary">Send</button>
      </div>
    </div>
  </div>
</div>
</body>
</html><?php }} ?>
