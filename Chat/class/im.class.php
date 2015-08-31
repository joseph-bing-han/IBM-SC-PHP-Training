<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/config/class.inc";

header("Content-Type: text/event-stream");
header('Cache-Control: no-cache');



if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	exit;
}
$currentUserDb = $_GET['id'].'_on';
$redis = new CRedis();
$db = Database::getInstance();
while(true){
	$msg = '';
	//$onlineMsg = array('time'=>date('Y-m-d H:i:s'),
// 						'msg'=>array('<span>roots </span><span>[2015-08-31 19:38:41]: </span><span>dfdfd</span>',
// 								'<span>root </span><span>[2015-08-31 19:38:41]: </span><span>dfdfd</span>',
// 								'<span>admin </span><span>[2015-08-31 19:38:41]: </span><span>dfdfd</span>'
// 	)
// 						);
	if($onlineMsg = json_decode($redis->get($currentUserDb), true)){
		foreach ($onlineMsg as $k => $v){
			$msg = $onlineMsg['msg'];
		}
	}
	$redis->set($currentUserDb, json_encode(array('time'=>date('Y-m-d H:i:s'), 'msg'=>array())));//update  current user online time

	$userlist = array();
	$rs = $redis->getOnlineUser();
	$userIds = join(',', $rs);
	$rs = $db->Query("select id,name,login_time from user where id in ($userIds)");
	if(count($rs) > 0){
		foreach ($rs as $k => $v){
			array_push($userlist, $v['name']);
		}
	}

	echo "data:".json_encode(array('msg'=>$msg, 'list'=>$userlist));

	echo "\n\n";

	@ob_flush();
	@flush();

	sleep(1);
}

?>
