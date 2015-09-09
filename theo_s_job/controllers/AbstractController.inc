<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/ControllerInterface.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/views/libs/Smarty.class.php';

abstract class AbstractController implements ControllerInterface {
	protected $smarty;
	protected $template;
	protected $requests;
	public function __construct() {
		global $_REQUEST;
		$this->requests = $_REQUEST;
		
		$this->smarty = new Smarty ();
		$this->smarty->debugging = false;
		$this->smarty->caching = true;
		$this->smarty->cache_lifetime = 120;
		
		$this->_set_template ();
	}
	abstract protected function _set_template();
}