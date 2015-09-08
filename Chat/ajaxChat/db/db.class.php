<?php
require_once("define.php");

class db {
	private static $cennct = null;	// 记录PDO连接方法
	private static $pd = null;	// 记录实例后的类

	private function __construct(){}	// 禁用new直接实例本类

	/**
	 *  connection DB
	 */
	private function conn(){
		$pdo = new PDO('mysql:host='.HOST.';dbname='.DBNAME,USER,PASS);	// 连接数据库
		$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);		// 存储过程设置
		$pdo->query("set names utf8");						// 字符集
		return $pdo;								// 返回
	}

	/**
	 * get db connection
	 */
	public static function getdb(){
		if(self::$pd == null)
            		self::$pd = new db();
		
		if(self::$cennct  == null )
			self::$cennct  = self::$pd->conn();	
        	return self::$pd;
	}
	
	/**
	 * insert chat context
	 */
	public function insertlts($say,$user,$time){
		if(self::$cennct->exec("insert into list values('$user','$time','$say')"))
			return true;	
		return false;
	}

	/**
	 * read chat context
	 */
	public function getlts(){
		$tmp = self::$cennct->query("select count(addtime) as num from list");
		$num = $tmp->Fetch(PDO::FETCH_ASSOC);
		$sql = "select * from list order by addtime asc";
		if($num['num']>100)
			$sql .= " limit ".($num['num']-100).",10";
		$tmp = self::$cennct->query($sql);	
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
	
	/**
	 * read userSession context
	 */
	public function getUserSession(){
		$sql = "select * from user_session order by activitytime asc";
		$tmp = self::$cennct->query($sql);
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
	
	/**
	 * user Login
	 */
	
	public function login($username,$password){
		$tmp = self::$cennct->query("select * from user where username='".$username."' and password='".$password."'");
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		return $data;
	}
	
	/**
	 * user register
	 */
	public function register($username,$password){
		if(self::$cennct->exec("insert into user values('$username','$password')"));
			return true;
		return false;
	}
	
	/**
	 * whether if exist username in DB
	 */
	public function getUserName($username){
		$tmp = self::$cennct->query("select * from user where username='".$username."'");
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		if(count($data)==1){
			return false;
		}else {
			return true;
		}
	}
	
	/**
	 * whether if exist SessionUserName in DB
	 */
	public function getSessionUserName($userid){
		$tmp = self::$cennct->query("select * from user_session where userid='".$userid."'");
		$data = $tmp->FetchAll(PDO::FETCH_ASSOC);
		if(count($data)==1){
			return true;
		}else {
			return false;
		}
	}
	
	public function addActivityUser($username,$time){
		if(self::$cennct->exec("insert into user_session values('$username',now())"));
			return true;
		return false;
	}
	
 	/**
	 * update sessionDate register
	 */
	 
	public function updateSessionDate($userid,$time){
		if(self::$cennct->exec("update  user_session set activitytime=now() where userid='".$userid."'"));
			return true;
		return false;
	} 
	
	public function deleteOverTimeUser(){
		if(self::$cennct->exec("delete from user_session where  (UNIX_TIMESTAMP(now()) - UNIX_TIMESTAMP(activitytime))>180"));
			return true;
		return false;
	}
}
