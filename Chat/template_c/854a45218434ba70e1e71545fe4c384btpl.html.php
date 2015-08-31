<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>SCS 聊天室</title>
	<link rel="stylesheet" href="./css/chat.css">
</head>
<body>

	<div id="c_login">
		<h1>SCS</h1>
		<form action="./router.php" method="post">
			<input type="text" placeholder="请输入用户名" name="username" autofoucus>
			<input type="password" placeholder="请输入密码" name="password">

			<input type="submit" name="submit" value="登录" >
			<input type="submit" name="register" value="注册">
		</form>
	</div>

</body>
</html>
