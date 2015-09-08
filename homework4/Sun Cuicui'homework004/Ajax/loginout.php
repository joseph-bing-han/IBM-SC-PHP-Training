<?php
// 用户退出登录请求处理
require_once 'Mysql.php';
session_start ();
$username = $_SESSION ["Name"];
$db = new Mysql ( "localhost:3306", "root", "scc880811", "factory" );
$delete = $db->delete ( "onlineuser", "WHERE name ='$username'" );
if (mysql_errno ()) {
	die ( "fail to delete id $user_id" );
	echo mysql_error ();
} else {
	header ( "Location:login.php" );
}
$db->CloseDb ();
?>