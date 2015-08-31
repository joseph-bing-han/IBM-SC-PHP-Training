<?php

class Database extends AbstractDB{

	/**
	 * @var $dblink resource
	 * @access current class
	 */
	protected $dblink;
	/**
	 * @var $instance object
	 * @access current class
	 */
	protected static $instance = null;

	/**
	 * __construct
	 */
	private function __construct(){
		global $CONFIG;
		$db_host = $CONFIG['db_host'];
		$db_name = $CONFIG['db_name'];
		$db_password = $CONFIG['db_password'];
		$db_user = $CONFIG['db_user'];
		$db_port = $CONFIG['db_port'];
		$db_encoding = $CONFIG['db_encoding'];

		// Must have a database name
		if ( ! $db_name )
		{
			echo new Exception('Require $dbname to select a database '.__FILE__.' on line '.__LINE__);

		}
		// Must have a user and a password
		if ( ! $db_user || !$db_password)
		{
			echo new Exception('Require $db_user and $db_password to connect to a database server '.__FILE__.' on line '.__LINE__);
		}

		$this->dblink = new mysqli($db_host, $db_user,$db_password,'' , $db_port) or die(mysqli_errno($this->dblink));

		if( $this->dblink->connect_errno )
		{
			echo new Exception('Error establishing mySQLi database connection in '.__FILE__.' on line '.__LINE__);
		}
		else if ( !@$this->dblink->select_db($db_name) )
		{
			// Try to get error supplied by mysql if not use our own
			if ( !$str = @$this->dblink->error)
				echo new Exception('Unexpected error while trying to select database in '.__FILE__.' on line '.__LINE__);
		}
		else
		{

			if($db_encoding!='')
			{
				$charsets = array();

				$result = $this->dblink->query("SHOW CHARACTER SET");
				while($row = $result->fetch_array(MYSQLI_ASSOC))
				{
					$charsets[] = $row["Charset"];
				}
				if(in_array($db_encoding, $charsets)){
					$this->dblink->query("SET NAMES '".$db_encoding."'");
					mysqli_select_db($this->dblink, $db_name);
				}
			}
		}

	}
	/**
	 * Database instance
	 * @return  $self::instance object
	 */
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * 转化特殊字符
	 * @param string $string
	 * @return string 处理后的字符串
	 * @access public
	 */
	public function clean($string){
		return mysqli_real_escape_string($this->dblink, $string);
	}

	/**
	 * 执行SQL语句
	 * @param string $query sql 语句
	 * @return object resource or false;
	 * @access public
	 */
	public function execute($query){
		return mysqli_query($this->dblink, $query);
	}
	/**
	 * 获取上一条语句的执行ID
	 * @param string $query sql 语句
	 * @return integer number or false;
	 * @access public
	 */
	public function insert_get_id($query){
		$this->execute($query);
		return mysqli_insert_id($this->dblink);

	}
	/**
	 * 获取SQL语句返回的数组
	 * @param string $query sql
	 * @return object resource or false;
	 * @access public
	 */
	public function Query($query){
		$result = $this->execute($query);
		$return = array();
		if($result){
			while($row = mysqli_fetch_array($result , MYSQL_ASSOC)){
				$return[] =$row;
			}
		}
		return $return;
	}
}

?>
