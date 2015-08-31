<?php
/**
 *
 * @author David
 *
 */
class  scsLogin{

	/**
	 * database instance
	 * @var db
	 */
	private $db;
	/**
	 * __construct
	 */
	function __construct(){
		$this->db = Database::getInstance();
	}
	/**
	 * init login page
	 */
	public static function init(){
		$tpl = new template();
		$tpl->assign("CTITLE", "聊天室:登录");
		$tpl->assign('CSUBTITLE', "Welcome 聊天室");
		$tpl->assign('CPLACEUSERNAME', "请输入用户名");
		$tpl->assign('CPLACEPASSWORD', "请输入密码");
		$tpl->assign('CVALSUBMIT', "登录");
		$tpl->assign('CVALREG', "注册");
		$tpl->display("tpl.login.html");
	}
	/**
	 *
	 * validate user data
	 * @param array $data
	 * @return boolean
	 */
	public function validator($data){

		$userName = isset($data['username']) ? trim($data['username']) : '';
		$password = isset($data['password']) ? md5($data['password']) : '';

		if(!empty($userName)&& !empty($password))
		{


			$rs = $this->db->Query("select id,login_time from user where name = '{$userName}' and password='{$password}'");
			if (count($rs) > 0 && $rs = $rs[0]){
				$this->db->execute("update user set online = 1, login_time = now() where id = {$rs['id']}");

				$sessionId = session_id();
				$_SESSION['username'] = $userName;
				$_SESSION['userid'] = $rs['id'];
				$_SESSION['session_id'] = $sessionId;

				return true;
			}
		}
		return false;
	}
	/**
	 *
	 * @param array $data
	 * @return boolean
	 */
	public function register($data){
		$userName = isset($data['username']) ? trim($data['username']) : '';
		$password = isset($data['password']) ? md5($data['password']) : '';

		if(!empty($userName)&& !empty($password))
		{
			$r = $this->db->Query("select id from user where name = '$userName'");
			if(count($r) == 1){
				return false;
			}
			$rs = $this->db->execute("insert into user set name = '{$userName}', password='{$password}', create_time = now(), online = 1");

			if (count($rs) == 1){
				session_start();
				$sessionId = session_id();
				$_SESSION['username'] = $userName;
				$_SESSION['userid'] = $this->db->insert_get_id("select last_insert_id()");
				$_SESSION['session_id'] = $sessionId;

				return true;
			}
		}
		return false;
	}
	/**
	 * Redirect to target page
	 */
	public function redirector(){
		$url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].'/Chat/chatroom/';
		header('Location: '.$url);
		exit;
	}

}
?>
