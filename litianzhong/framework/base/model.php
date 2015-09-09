<?php
/**
 * 基础model
 * @author      李天中
 * @version     1.0
 */
class Model {
	protected $db = null;
	
	final public function __construct() {
		$this->db=Application::$_lib["DbKit"];
		Application::$_lib["LogUtil"]->log(print_r($this->db,true));
	}
	/**
	 * 获得$CONFIG['system'][$config]
	 * @access      final   protected
	 * @param       string  $config 
	 */
	final   protected function config($config=''){
		return Application::$_config[$config];
	}




}