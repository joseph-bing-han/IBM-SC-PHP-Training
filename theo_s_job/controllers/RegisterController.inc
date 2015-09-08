<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AbstractController.inc';
class RegisterController extends AbstractController {
	const TEMPLATE_URI = 'register.html';
	const ROUTER_ID = 0;
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	public function run() {
		if (isset ( $this->requests ['submit'] )) {
			$user = new User ();
			$user->_set_name ( $this->requests ['name'] );
			$user->_set_email ( $this->requests ['email'] );
			$user->set_password ( $this->requests ['password'] );
			try {
				$user->add_user ();
			} catch ( UserException $e ) {
				$this->smarty->assign ( 'result_message', $e->getMessage (), true );
				return;
			}
			
			$this->smarty->assign ( 'result_message', 'your id has been created.' );
		} else {
			$this->smarty->assign ( 'result_message', 'Please input your information for register.', true );
			$this->smarty->assign ( 'router_id', self::ROUTER_ID, false );
		}
		$this->smarty->display ( $this->template );
	}
}