<!DOCTYPE html>
<html>
<head><title>用户注册</title>
<script language="javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/login.js"></script>
<script type="text/javascript">
$(function(){
	$("#getcode_num").click(function(){
		$(this).attr("src",'config/code_num.php?' + Math.random());
	});
});
</script>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" />
<meta content="yes" name="apple-mobile-web-app-capable" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body onLoad="getfocus()">
  <div class="header">
    <div class="title" id="titleString">用户注册</div>
  </div>

        
<div class="container">
  <form name="admin" method="post" action="login.php" id="admin" >

  <div class="control-group">
  &nbsp;&nbsp;用户名：
  <input name="userid" type="text" id="userid" style="width:100px; background: none repeat scroll 0 0 #F9F9F9; padding: 8px 0px 8px 4px; " onBlur="regcheck(this)"/>
  </div>
  <div style="margin-top:10px;" align="center" id="showmsg"></div>
  <div class="control-group">
  设置密码：
  <input name="pass1" type="password" id="pass1" style="width:100px; background: none repeat scroll 0 0 #F9F9F9;padding: 8px 0px 8px 4px" />
  </div>

  <div class="control-group">
  再次输入：
  <input name="pass2" type="password" id="pass2" style="width:100px; background: none repeat scroll 0 0 #F9F9F9;padding: 8px 0px 8px 4px" />
  </div>
  <div class="control-group">
  <img src="config/code_num.php" id="getcode_num" title="看不清，点击换一张" align="absmiddle">
  <input name="checkcode" type="text" id="checkcode" style="width:100px; background: none repeat scroll 0 0 #F9F9F9;padding: 8px 0px 8px 4px" />
  </div>
  <div style="margin-top:10px;" align="center" id="showmsg2"></div>

  <div class="control-group">
  <input name="regbtn" type="button" class="btn-large black" id="regbtn" onClick="return reg();" value="立即注册">
  </div>
  <div class="control-group">
     已有账号？<a href="login.php" id="regbtn">立即登录</a>
  </div>
  </form>
</div>

</body>
</html>