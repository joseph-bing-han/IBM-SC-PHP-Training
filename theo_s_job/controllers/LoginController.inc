<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AbstractController.inc';
class LoginController extends AbstractController {
	const TEMPLATE_URI = 'login.html';
	const ROUTER_ID = 2;
	protected $template;
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	public function run() {
		if (isset ( $this->requests ['submit'] )) {
			// handdle login
			$secuser = SecUser::_get_instance ( $this->requests ['email'] );
			
			if ($secuser->_auth ( $this->requests ['password'] )) {
				// start session and save email address
				session_start ();
				$_SESSION ['email'] = $this->requests ['email'];
				// redirect to messager
				header ( 'location:./index.php?router_id=1' );
			} else {
				$this->smarty->assign ( 'result_message', 'Login failed, please try again.' );
			}
		} else {
			$this->smarty->assign ( 'result_message', 'Please login' );
		}
		$this->smarty->display ( $this->template );
	}
}