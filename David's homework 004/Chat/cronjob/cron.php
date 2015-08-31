<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/config/class.inc";
/**
 * init redits for user ids
 */
$redis = new cRedis();

$db = Database::getInstance();
$rs = $db->Query("SELECT id from user where active = 1");
if(count($rs) > 0){
	$array = array();
	foreach ($rs as $k => $v){
		array_push($array, $v['id']);
	}
	$str = join(',', $array);
	$redis->set('userid', $str);
}

while (true){
	$redis->validateOnlineUser();
	sleep(2);
}


?>
