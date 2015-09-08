<?php

class Chat{
	public static function regist($userid,$pass){
		$mysql = mysql::getInstance();

		$result = $mysql->query("insert into user (userid,password) values ('".$mysql->changestring($userid)."','".md5($pass)."')");

		return array(
			'sts'=> $result
		);
	}

	public static function checkUser($userid,$pass){
		$mysql = mysql::getInstance();

		$result = $mysql->getunique("SELECT * FROM user WHERE userid = '".$userid."'");

		if($result == ''){

			return array(
				'sts'=> 0,
				'msg'	=> '用户名或密码不正确'
			);
		}else{
			if($result['password'] != md5($pass)){
				return array(
					'sts'=> 0,
					'msg'	=> '用户名或密码不正确'
				);
			}else{
				// $_SESSION['user']['name'] = $userid;
				$_SESSION["userid"] = $userid;
				$_SESSION["logininfo"] = md5($_SESSION["userid"]);
				return array(
					'sts'=> 1
				);
			}
		}		
	}

	public static function checkExist($userid){
		$mysql = mysql::getInstance();

		$result = $mysql->getunique("select * from user where userid = '" . $userid ."'");

		if($result == ''){
			return array(
				'sts'	=> 1
			);
		}else{
			return array(
				'sts'	=> 0,
				'msg'	=> '<font style=\'color:red;\'>已经存在该用户名</font>'
			);
		}
	}

	public static function insertActive($userid){
		$mysql = mysql::getInstance();

		$result = $mysql->getunique("SELECT * FROM active WHERE user = '".$userid."'");

		if($result == ''){
			$sql = "insert into active (user,active) values ('" . $userid . "','" .date('y-m-d H:i:s',time()) ."')";

			$mysql->query($sql);

			$sql = "insert into chat (comment,userid,updatetime) values ('欢迎用户：".$userid ."','systerm','".date('y-m-d H:i:s',time())."')";

			$mysql->query($sql);
		}else{
			$sql = "update active set active = '" . date('y-m-d H:i:s',time()) . "' where user = '" . $userid ."'";

			$mysql->query($sql);
		}
		

	}
	
	public static function logout(){
		$mysql = mysql::getInstance();

		$mysql -> query("delete from active where user = '" . $_SESSION["userid"] ."'");

		unset($_SESSION["logininfo"]);
		unset($_SESSION["userid"]);

		return array(
			'sts'	=> 1
		);
	}
	
	public static function submitChat($chatText){
		$mysql = mysql::getInstance();
		$insertSQL = "insert into chat (comment,userid,updatetime) values ('" . $mysql->changestring($chatText) . "','".$_SESSION["userid"]."','".date('y-m-d H:i:s',time())."')";
		$mysql -> query($insertSQL);
	
		return array(
			'sql'	=> $insertSQL
		);
	}
	
	public static function getUsers(){

		$mysql = mysql::getInstance();

		//更新在线状态
		$mysql->query("update active set active = '" . date('y-m-d H:i:s',time()) . "' where user = '". $_SESSION["userid"] . "'");
		
		// 删除10分钟以内的聊天记录,从在线用户表删除2分钟内未更新状态的user
		$mysql->query("DELETE FROM chat WHERE updatetime < SUBTIME(NOW(),'0:10:0')");
		$mysql->query("DELETE FROM active WHERE active < SUBTIME(NOW(),'0:2:00')");

		
		$result = $mysql->getarray('SELECT * FROM active ORDER BY user ASC LIMIT 18');
	
		return array(
			'users' => $result
		);
	}
	
	public static function getChats($lastID){
		$lastID = (int)$lastID;

		$mysql = mysql::getInstance();
		$result = $mysql->getarray('SELECT * FROM chat WHERE id > '.$lastID.' ORDER BY id ASC');

		return array('chats' => $result);
	}

}


?>