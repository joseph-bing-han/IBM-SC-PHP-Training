<?php
/**
 * 登录的处理
 * @author      李天中
 * @version     1.0
 */
require "cache.php";
class homeController extends Controller {
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 登录页
	 */
	public function index() {
		$state = cache::get ( "__corn" );
		if (("" == $state) || ("0" == $state)) {
			cache::set ( "__corn", "1" );
			$this->runThread ();
		}
		$this->display ( "login.html" );
	}
	
	/**
	 * **
	 * validate ajax
	 */
	public function check() {
		header ( 'Content-Type: application/json; charset=utf-8' );
		parent::$LogUtil->log ( print_r ( $_POST, true ) );
		$model = $this->model ( "home" ); // 获得model
		$user = json_decode ( $_POST ["model"] );
		if ($model->countLogin ( $user ) > 0) { // if user has login
			$msg = array (
					"code" => "0",
					"tip" => "user has login!" 
			); // 成功提示信息
			echo json_encode ( $msg );
			exit ();
		}
		
		$info = $model->checkUser ( $user );
		$msg = array ();
		if ($info ["flag"]) {
			Application::$_lib ["SessionAuth"]->set ( "_USER", $info ["name"] ); // 校验成功放入session
			Application::$_lib ["SessionAuth"]->set ( "_ID", $user->username ); // 校验成功放入session
			$msg = array (
					"code" => "1",
					"tip" => "" 
			); // 成功提示信息
		} else {
			$msg = array (
					"code" => "0",
					"tip" => "username or password is wrong!" 
			); // 成功提示信息
		}
		echo json_encode ( $msg );
	}
	/**
	 * *
	 * login ajax
	 */
	public function login() {
		$user = Application::$_lib ["SessionAuth"]->get ( "_USER" );
		$userid = Application::$_lib ["SessionAuth"]->get ( "_ID" );
		if ($user) {
			/**
			 * *notice user
			 */
			$this->dbLogin ( $userid, $user );
			$this->display ( "main.html" );
		} else {
			$this->display ( "login.html" );
		}
	}
	/**
	 * *
	 * forward register.html
	 */
	public function forRegister() {
		$this->display ( "register.html" );
	}
	/**
	 * *
	 * validate id unique
	 */
	public function valId() {
		$id = $_POST ["id"]; //
		$model = $this->model ( "home" ); // 获得model
		$result = $model->valId ( $id );
		echo json_decode ( $result );
	}
	/**
	 * *
	 * register
	 */
	public function register() {
		$userid = $_POST ["userid"];
		$username = $_POST ["username"];
		$password = $_POST ["password"];
		$model = $this->model ( "home" ); // 获得model
		$result = $model->register ( $userid, $username, $password ); // insert info
		echo json_decode ( $result );
	}
	/**
	 * *
	 * record database
	 *
	 * @param String $id        	
	 * @param String $name        	
	 */
	private function dbLogin($id, $name) {
		$model = $this->model ( "home" ); // 获得model
		$model->dbLogin ( $id, $name ); // update or insert login info
		$model->updateLogin ( $id ); // notice others
	}
	/**
	 * *
	 * 运行线程
	 */
	private function runThread() {
		$srv_ip = '127.0.0.1'; // 你的目标服务地址.
		$srv_port = 80; // 端口
		$url = '/chat/index.php/corn/corntable'; // 接收你post的URL具体地址
		$fp = '';
		$errno = 0; // 错误处理
		$errstr = ''; // 错误处理
		$timeout = 10; // 多久没有连上就中断
		$post_str = ""; // 要提交的内容.
		                // 打开网络的 Socket 链接。
		$fp = fsockopen ( $srv_ip, $srv_port, $errno, $errstr, $timeout );
		if (! $fp) {
			echo ('fp fail');
		}
		$content_length = strlen ( $post_str );
		$post_header = "POST $url HTTP/1.1\r\n";
		$post_header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$post_header .= "User-Agent: MSIE\r\n";
		$post_header .= "Host: " . $srv_ip . "\r\n";
		$post_header .= "Content-Length: " . $content_length . "\r\n";
		$post_header .= "Connection: close\r\n\r\n";
		$post_header .= $post_str . "\r\n\r\n";
		fwrite ( $fp, $post_header );
		fclose ( $fp );
	}
}

