<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/ControllerRouter.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/libs/db/MysqliDb.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/config/Config.inc';

class ChatRoom{
	public static function  run(){
		header ( 'Access-Control-Allow-Origin:*' );
		$db = new MysqliDb ( Config::$db_mysql ['host'], Config::$db_mysql ['user'], Config::$db_mysql ['password'], Config::$db_mysql ['database'] );
		$cr = new ControllerRouter ();
		if (! isset ( $_REQUEST ['router_id'] )) {
			$_REQUEST ['router_id'] = LoginController::ROUTER_ID;
		}
		try {
			$cr->dispatch ( $_REQUEST ['router_id'] );
		} catch ( Exception $e ) {
			echo $e->getMessage ();
		}
	}
}

ChatRoom::run();

