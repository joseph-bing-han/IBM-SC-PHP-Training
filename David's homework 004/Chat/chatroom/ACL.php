<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/config/class.inc";
class ACL extends AbstractACL{
	/**
	 * acl control for chatroom
	 */
	public static function hasAccess(){
		session_start();
		if(!isset($_COOKIE['PHPSESSID']) || !isset($_SESSION['session_id'])
				|| $_COOKIE['PHPSESSID'] !== $_SESSION['session_id']){
			$url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/Chat/';
			header('Location: '.$url);
			exit;
		}

	}
}
?>
