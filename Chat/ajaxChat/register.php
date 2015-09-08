<?php 
require_once("./db/db.class.php");
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
$username = $_POST['username'];
$password1 = $_POST['password1']; 
$password2 = $_POST['password2'];
$isRegister = db::getdb()->getUserName($username);
echo $isRegister;
if($isRegister){ // username isn't exist
	$isInsert = db::getdb()->register($username, $password1);
	if($isInsert){//register success
		echo "<script> alert('register success!');parent.location.href='Login.html'; </script>";
	}else{
		echo "<script> alert('register fail');parent.location.href='register.html'; </script>";
	}
	
}else{// username is exist
	echo "<script> alert('username is exist!');parent.location.href='register.html'; </script>";
}
