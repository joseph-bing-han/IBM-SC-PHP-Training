<?php
// 新用户注册处理
require_once 'Mysql.php';
if(!isset($_POST['username'])){
	die('username not define');
}
if(!isset($_POST['password'])){
	die('password not define');
}
if(!isset($_POST['email'])){
	die('email not define');
}
$username=$_POST['username'];
if(empty($username)){
	die('username is empty');
}
$password=$_POST['password'];
if(empty($password)){
	die('password is empty');
}
$email=$_POST['email'];
if(empty($email)){
	die('email is empty');
}
$db= new Mysql("localhost:3306","root","scc880811","factory");
$result= $db->insert("t_user", "(username,password,email)","('$username','$password','$email')");
if(mysql_errno()){
	echo mysql_error();
}else{
	header("Location:login.php");
}
$db->CloseDb();
?>