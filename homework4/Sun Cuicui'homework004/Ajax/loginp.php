<?php
// 用户登录请求处理
require_once 'Mysql.php';
$username = htmlspecialchars($_POST['username']);
$password = $_POST['password'];
	$db= new Mysql("localhost:3306","root","scc880811","factory");
    $select = $db->select("t_user","where username='".$username."'and password='".$password."'");
	 $falg = false;
	while($row=mysql_fetch_array($select)){
		$falg=true;
	}
 	if($falg){
		//创建session
		session_start();
		$_SESSION["Name"]=$username;
		$name=$_SESSION["Name"];
		$insert=$db->insert("onlineuser", "(name)", "('$name')");
		header("location:index.php");
	}
	else{
		header("location:login.php");
	} 

?>