<?php
class Mysql{
	private $host;
	private $root;
	private $password;
	private $database;
	function __construct($host,$root,$password,$database){
		$this->host=$host;
		$this->root=$root;
		$this->password=$password;
		$this->database=$database;
		$this->connect();
	}
	//建立数据库连接
	function connect(){
		$this->conn=mysql_connect($this->host,$this->root,$this->password,$this->database)or die ("mysql链接失败");
		if(mysql_select_db($this->database,$this->conn)){
// 			echo 'success';
		} else {
			echo mysql_error();
		}
		mysql_query('SET NAMES UTF8')or die ("字符集设置错误");
	}
	//关闭数据库
	function closeDb(){
		mysql_close($this->conn);
	}
	//定义数据库
	function query($sql){
		return mysql_query($sql);
	}
	function Myarray($result){
		return mysql_fetch_assoc($result);
	}
	//定义结果的条数
	function num($result){
		return mysql_num_rows($result);
	}
	//自定义查询方法
	function select($tableName,$condition){
	    return $this->query("SELECT * FROM $tableName $condition");	
	}
	//自定义查询所有数据方法
	function selectall($tableName){
		return $this->query("SELECT * FROM $tableName");
	}
	//自定义去重查询方法
	function selectdistinct($value,$tableName){
		return $this->query("SELECT distinct $value FROM $tableName");
	}
	//自定义插入方法
	function insert($tableName,$fields,$value){	
		$this->query("INSERT INTO $tableName $fields VALUES $value");	
	}
	//自定义更新方法
	function update($tableName,$change,$condition){
	    $this->query("UPDATE $tableName SET $change $condition");	
	}
	//自定义删除方法
	function delete($tableName,$condition){
		$this->query("DELETE FROM $tableName $condition");
	}
}

