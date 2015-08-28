<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AbstractController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/SecUser.inc';

class MessagerController extends AbstractController{
	const TEMPLATE_URI = 'messager.html';
	const ROUTER_ID = 1;
	
	protected $secuser;
	
	protected $template;
	
	public function __construct(){
		parent::__construct();
		 $this->secuser = SecUser::_get_instance();
	}
	
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	
	public function run(){
		$this->smarty->assign('username', $this->secuser->_get_user()->_get_name(), true);
		$this->smarty->assign('email', $this->secuser->_get_user()->_get_email(), true);
		$this->smarty->display($this->template);
	}
}