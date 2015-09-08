<?php
// 左侧用户登录显示处理
require_once 'Mysql.php';
$db= new Mysql("localhost:3306","root","scc880811","factory");
$select = $db->selectdistinct("name", "onlineuser");
$row = $db->num($select);
for($i=0;$i<$row;$i++){
	$result_arr=$db->Myarray($select);
	$name=$result_arr['name'];
	echo "<tr><td>在线用户:$name</td><tr>";
}
$db->closeDb();
?>