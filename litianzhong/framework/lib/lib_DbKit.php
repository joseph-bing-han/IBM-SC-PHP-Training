<?php
class DbKit {
	protected $_mysqli; // database connection
	public static $_instance; //
	/**
	 * *
	 * construct function
	 * init _mysqli & $_instance
	 */
	public function __construct() {
		if (! $this->_mysqli)
			$this->connect ();
		self::$_instance = $this;
	}
	/**
	 * static var
	 * 
	 * @return DbKit
	 */
	public static function getInstance() {
		return self::$_instance;
	}
	/**
	 * according to 'config.php'
	 * get database connetion
	 *
	 * @return _mysqli
	 */
	private function connect() {
		if (empty ( Application::$_config['db']["host"] )) {
			die ( "please set host in config.php" );
		}
		$this->_mysqli = new mysqli ( Application::$_config['db']["host"], Application::$_config['db']["user"], Application::$_config['db']["password"], Application::$_config['db']["db"] );
		if ($this->conn->connect_error) {
			die ( "connect database fail!" . $this->_mysqli->connect_error );
		}
		// set charset default utf8
		$this->_mysqli->set_charset ( "utf8" );
	}
	
	/**
	 * This method for update or insert
	 * can prvent SQL injection
	 *
	 * @param String $sql        	
	 * @param array $params        	
	 * @return bool ture is sucess,false is fail
	 */
	public function execute($sql, $params = null) {
		$array = array (
				'' 
		);
		$stmt = $this->_mysqli->prepare ( $sql );
		if ($stmt) {
			if (is_array ( $params ) === true) {
				foreach ( $params as $prop => $val ) {
					$array [0] .= $this->_determineType ( $val );
					array_push ( $array, $params [$prop] );
				}
				call_user_func_array ( array (
						$stmt,
						'bind_param' 
				), $this->refValues ( $array ) );
				$result = $stmt->execute ();
			}
			$stmt->close ();
		}
		return $result;
	}
	/**
	 * Execute raw SQL query.
	 *
	 * @param string $query
	 *        	User-provided query to execute.
	 * @param array $bindParams
	 *        	Variables array to bind to the SQL statement.
	 *        	
	 * @return array Contains the returned rows from the query.
	 */
	public function rawQuery($query, $bindParams = null) {
		$params = array (
				'' 
		); // Create the empty 0 index
		$stmt = $this->_mysqli->prepare ( $query );
		if (is_array ( $bindParams ) === true) {
			foreach ( $bindParams as $prop => $val ) {
				$params [0] .= $this->_determineType ( $val );
				array_push ( $params, $bindParams [$prop] );
			}
			call_user_func_array ( array (
					$stmt,
					'bind_param' 
			), $this->refValues ( $params ) );
		}
		$stmt->execute ();
		$this->replacePlaceHolders ( $query, $params );
		$result = $this->_dynamicBindResults ( $stmt );
		return $result;
	}
	/**
	 * Helper function to execute raw SQL query and return only 1 row of results.
	 * Note that function do not add 'limit 1' to the query by itself
	 *
	 * @param string $query
	 *        	User-provided query to execute.
	 * @param array $bindParams
	 *        	Variables array to bind to the SQL statement.
	 *        	
	 * @return array Contains the returned row from the query.
	 */
	public function rawQueryOne($query, $bindParams = null) {
		$res = $this->rawQuery ( $query, $bindParams );
		if (is_array ( $res ) && isset ( $res [0] ))
			return $res [0];
		return null;
	}
	
	/**
	 * Helper function to execute raw SQL query and return only 1 column of results.
	 *
	 * @param string $query
	 *        	User-provided query to execute.
	 * @param array $bindParams
	 *        	Variables array to bind to the SQL statement.
	 *        	
	 * @return mixed Contains the returned rows from the query.
	 */
	public function valueQuery($query, $bindParams = null) {
		$res = $this->rawQuery ( $query, $bindParams );
		if (! $res)
			return null;
		$key = key ( $res [0] );
		if (isset ( $res [0] [$key] ))
			return $res [0] [$key];
	}
	/**
	 * *
	 * Because referenced data array is required by mysqli since php 5.3+
	 *
	 * @param array $arr        	
	 * @return Array
	 */
	protected function refValues(Array &$arr) {
		// Reference in the function arguments are required for HHVM to work
		// https://github.com/facebook/hhvm/issues/5155
		// Referenced data array is required by mysqli since PHP 5.3+
		if (strnatcmp ( phpversion (), '5.3' ) >= 0) {
			$refs = array ();
			foreach ( $arr as $key => $value )
				$refs [$key] = & $arr [$key];
			return $refs;
		}
		return $arr;
	}
	/**
	 * This method is needed for prepared statements.
	 * They require
	 * the data type of the field to be bound with "i" s", etc.
	 * This function takes the input, determines what type it is,
	 * and then updates the param_type.
	 *
	 * @param mixed $item
	 *        	Input to determine the type.
	 *        	
	 * @return string The joined parameter types.
	 */
	protected function _determineType($item) {
		switch (gettype ( $item )) {
			case 'NULL' :
			case 'string' :
				return 's';
				break;
			case 'boolean' :
			case 'integer' :
				return 'i';
				break;
			case 'blob' :
				return 'b';
				break;
			case 'double' :
				return 'd';
				break;
		}
		return '';
	}
	/**
	 * Function to replace ? with variables from bind variable
	 *
	 * @param string $str        	
	 * @param Array $vals        	
	 *
	 * @return string
	 */
	protected function replacePlaceHolders($str, $vals) {
		$i = 1;
		$newStr = "";
		while ( $pos = strpos ( $str, "?" ) ) {
			$val = $vals [$i ++];
			if (is_object ( $val ))
				$val = '[object]';
			if ($val === NULL)
				$val = 'NULL';
			$newStr .= substr ( $str, 0, $pos ) . "'" . $val . "'";
			$str = substr ( $str, $pos + 1 );
		}
		$newStr .= $str;
		return $newStr;
	}
	
	/**
	 * This helper method takes care of prepared statements' "bind_result method
	 * , when the number of variables to pass is unknown.
	 *
	 * @param mysqli_stmt $stmt
	 *        	Equal to the prepared statement object.
	 *        	
	 * @return array The results of the SQL fetch.
	 */
	protected function _dynamicBindResults(mysqli_stmt $stmt) {
		$parameters = array ();
		$results = array ();
		// See http://php.net/manual/en/mysqli-result.fetch-fields.php
		$mysqlLongType = 252;
		$shouldStoreResult = false;
		$meta = $stmt->result_metadata ();
		// if $meta is false yet sqlstate is true, there's no sql error but the query is
		// most likely an update/insert/delete which doesn't produce any results
		if (! $meta && $stmt->sqlstate)
			return array ();
		$row = array ();
		while ( $field = $meta->fetch_field () ) {
			if ($field->type == $mysqlLongType)
				$shouldStoreResult = true;
			else {
				$row [$field->name] = null;
				$parameters [] = & $row [$field->name];
			}
		}
		// avoid out of memory bug in php 5.2 and 5.3. Mysqli allocates lot of memory for long*
		// and blob* types. So to avoid out of memory issues store_result is used
		// https://github.com/joshcam/PHP-MySQLi-Database-Class/pull/119
		if ($shouldStoreResult)
			$stmt->store_result ();
		call_user_func_array ( array (
				$stmt,
				'bind_result' 
		), $parameters );
		while ( $stmt->fetch () ) {
			$x = array ();
			foreach ( $row as $key => $val )
				$x [$key] = $val;
			array_push ( $results, $x );
		}
		if ($shouldStoreResult)
			$stmt->free_result ();
		$stmt->close ();
		return $results;
	}
	/**
	 * *
	 * destruct method
	 */
	public function __destruct() {
		if ($this->_mysqli)
			$this->_mysqli->close ();
	}
}
