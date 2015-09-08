<?php
// 发言窗口请求处理
require_once 'Mysql.php';
print_r($_POST);
$db= new Mysql("localhost:3306","root","scc880811","factory");
session_start();
$username=$_SESSION["Name"];
$data=$_POST['data'];
$result= $db->insert("message", "(username,data)","('$username','$data')");
if(mysql_errno()){
	echo mysql_error();
}else{
	header("Location:talk.php");
}
$select = $db->select('message');
$row = $db->num($select);
for($i=0;$i<$row;$i++){
	$result_arr=$db->Myarray($select);
	$data=$result_arr['data'];
	echo "$username说：.$data";
}

$db->CloseDb();
?>
