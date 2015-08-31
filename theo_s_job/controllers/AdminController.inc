<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/MessagerController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/ControllerException.inc';

class AdminController extends MessagerController{
	const TEMPLATE_URI = 'admin.html';
	const ROUTER_ID = 5;
	
	protected $secuser;
	
	protected $template;
	
	public function __construct(){
		parent::__construct();
		if(! SecUser::_get_instance()->_hasaccessto(SecUser::ACL_ADMIN)){
			throw new ControllerException('No access');
		}
	}
	
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	
	public function run(){		
		$db = MysqliDb::getInstance();
		$cols = array('idcr_user', 'cr_username', 'cr_useremail', 'cr_userlomd');
		$r = $db->get('cr_user', null, $cols);
		
		$this->smarty->assign('user_list', $r, true);
		$this->smarty->display($this->template);
	}
}
