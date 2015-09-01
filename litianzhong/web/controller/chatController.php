<?php
/***
 * chat room 
 * @author litz
 *
 */
require "cache.php";
class chatController extends Controller {
	const sleeptime = 500000;
	const time = 20;
	const exp = 30;
	public function __construct() {
		parent::__construct ();
	}
	/**
	 * get msgs and userlist
	 */
	public function getMsgs() {
		set_time_limit ( 0 ); // 无限请求超时时间
		$starttime = time (); // begin time
		$id = Application::$_lib ["SessionAuth"]->get ( "_ID" );
		$username = Application::$_lib ["SessionAuth"]->get ( "_USER" );
		session_write_close ();
		$model = $this->model ( "chat" ); // 获得model
		$model->updateLoginone ( $id ); // 更新登陆最新心跳时间
		
		while ( true ) {
			$sessionState = $model->selectLogin ( $id ); // get notice
			parent::$LogUtil->log(date('h:i:s',time()));//
			$info = cache::get ( $id );
			$message = $info ["message"];
			if (! empty ( $message ) || $sessionState == "1") { // if has message or userlist change
				$info ["message"] = array ();
				cache::set ( $id, $info );
				if ($sessionState == "1") {
					$userlist = $model->selectUsers ();
					$model->updateState ( $id ); // change state
				} else {
					$userlist = array ();
				}
				$retMsg = array (
						"user" => $userlist,
						"message" => $message 
				);
				echo json_encode ( $retMsg );
				exit ();
			}
			usleep ( self::sleeptime );
			
			if ((time () - $starttime) >= self::time) { // timeout
				echo json_encode ( "" );
				exit ();
			}
		}
	}
	/**
	 * send message
	 */
	public function sendMsg() {
		header ( 'Content-Type: application/json; charset=utf-8' );
		$model = $this->model ( "chat" ); // get model
		$msg = $_POST ["msg"];
		$userid = Application::$_lib ["SessionAuth"]->get ( "_ID" );
		$username = Application::$_lib ["SessionAuth"]->get ( "_USER" );
		session_write_close ();
		$userList = $model->selectUsers ();
		$currtime = date ( 'Y-m-d H:i:s', time () );
		foreach ( $userList as $value ) {
			$info = cache::get ( $value ["id"] );
			$messages = $info ["message"];
			$message = $username . "[" . $currtime . "]:" . $msg;
			if (! empty ( $messages )) {
				$messages [] = $message;
			} else {
				$messages = array (
						$message 
				);
			}
			$info ["message"] = $messages;
			cache::set ( $value ["id"], $info );
		}
		echo json_encode ( "" );
		exit ();
	}
	/**
	 * *
	 * logout
	 */
	public function logout() {
		$id = Application::$_lib ["SessionAuth"]->get ( "_ID" );
		$model = $this->model ( "chat" ); // 获得model
		$model->logout ( $id );
		$model->updateNotice ();
		session_destroy ();
		$this->display ( "login.html" );
	}
}