<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $CTITLE; ?></title>
	<link rel="stylesheet" href="/Chat/css/chat.css">
</head>
<body>

	<div id="c_login">
		<h1><?php echo $CSUBTITLE; ?></h1>
		<form action="./router.php" method="post">
			<input type="text" placeholder="<?php echo $CPLACEUSERNAME; ?>" name="username" autofoucus>
			<input type="password" placeholder="<?php echo $CPLACEPASSWORD; ?>" name="password">

			<input type="submit" name="submit" value="<?php echo $CVALSUBMIT; ?>" >
			<input type="submit" name="register" value="<?php echo $CVALREG; ?>">
		</form>
	</div>

</body>
</html>
