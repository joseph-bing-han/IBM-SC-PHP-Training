<!DOCTYPE html>
<html>
<head>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/login.js"></script>
<title>用户登录</title>
<meta content="yes" name="apple-mobile-web-app-capable" />
<link href="css/css.css" rel="stylesheet" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php 
session_name('webchat');
session_start();
	if($_SESSION["logininfo"] == md5($_SESSION["userid"])){
    echo '<script language="javascript" type="text/javascript">window.location="chat.php";</script>';
  }
?>
<div class="header">
  <div class="title" id="titleString">聊天室登陆</div>
</div>


<div class="container">
  <form name="admin" method="post" action="login.php" id="admin" >
    <div class="control-group">
  <input name="userid" type="text" id="userid" style="background: none repeat scroll 0 0 #F9F9F9;padding: 8px 0px 8px 4px" placeholder="请输入用户名" />
    </div>
    <div class="control-group">
        <input name="pass" type="password" id="pass" style="background: none repeat scroll 0 0 #F9F9F9;padding: 8px 0px 8px 4px" placeholder="请输入密码" />
    </div>
    <div class="control-group">
    		<div id="message"></div>
    </div>
    <div class="control-group">
      <input name="loginbtn" type="button" class="btn-large black" id="loginbtn" onClick="return check();" value="立即登陆">
    </div>
    <div class="control-group">
           还没账号？<a href="reg.php" id="regbtn">立即免费注册</a>
    </div>

  </form>
</div>

</body>
</html>