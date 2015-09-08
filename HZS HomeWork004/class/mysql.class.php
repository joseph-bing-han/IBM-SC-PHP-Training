<?php

	class mysql{
		private static $instance;
		private $host;
		private $name;
		private $pass;
		private $ut;
		private $link;
		private $table;
		private $debug;
		
		static public function getInstance(){
		    if (!isset(self::$instance)) {
		        self::$instance = new mysql();
		    }
		    return self::$instance;
		}

		private function __construct() {
			$this->debug = true;
		}

		function __destruct(){
			if($this->link){
				$this->close();
			}
		}

		//=================链接数据库=========================
		function connect(){
			$this->host = 'localhost';
			$this->name = 'root';
			$this->pass = '';
			$this->ut = 'utf-8';
			$this->table = 'test';

			$this->link=mysql_connect($this->host,$this->name,$this->pass) or die ('连接失败');
			mysql_select_db($this->table,$this->link) or die("没该数据库：".$this->table);
			mysql_query("SET NAMES '$this->ut'");
		}
		//==================判断SQL文是否正确/调试用====================
		function query($sql) {
			$this->connect();
			if(!($query = mysql_query($sql))){
				$this->show('这里出现SQL文问题:', $sql);
			}
			return $query;
		}
		//==================显示提示信息/调试用=========================
		function show($message = '', $sql = '') {
			if(!$this->debug){
				echo $message;
			}
			else{
				echo $message.'<br>'.$sql;
			}
		}
		//==========================取数据到数组+取得件数=======================
		function getarray($sql,&$num=0){
			$this->connect();
			if ($query = $this->query($sql)){
				$num = mysql_num_rows($query);
				$arr = array();
				while($row = mysql_fetch_array($query)){
					$arr[] = $row;
				}
				return $arr;
			}else{
				return '';
			}
		}
		//==========================取唯一一条数据============================
		function getunique($sql){
			$this->connect();
			if ($query = $this->query($sql)){
				$resault = mysql_fetch_array($query);
				return $resault;
			}else{
				return '';
			}
		}
		//==========================更新某表某字段=======================
		// function updatetable($table,$key,$field,$value){
		// 	$sql = "update $table set $field = '" . $value . "'";
		// 	return $this->query($sql);
		// }
		
		//=======================关闭已经打开的数据库==========================
		function close() {
			return mysql_close();
		}
		//=========================防止'字符出错===============================
		function changestring($str){
			return str_replace("'","''",$str);
		}
		//==========================向某表插入数据=================================
		function insert($table,$name,$value){
			$value = $this->changestring($value);
			$this->query("insert into $table ($name) value ($value)");
		}
		//==========================事务处理开始===============================
		function begin(){
			mysql_query("BEGIN");
		}
		//==========================事务处理提交===============================
		function commit(){
			mysql_query("COMMIT");
		}
		//==========================事务处理回滚===============================
		function rollback(){
			mysql_query("ROLLBACK");
		}

   }
   
?>
