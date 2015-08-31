<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AdminController.inc';
class AdminUpdateUController extends AdminController {
	const TEMPLATE_URI = 'adminu.html';
	const ROUTER_ID = 6;
	const MESSAGE_INFO = 'Please input the data to update';
	const MESSAGE_SUCC = 'Data updated';
	const MESSAGE_FAIL = 'Data update failed';
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	public function run() {
		$db = MysqliDb::getInstance ();
		
		if (isset ( $this->requests ['submit'] )) {
			$user = new User ();
			$user->init_by_id ( $this->requests ['idcr_user'] );
			if (isset ( $this->requests ['cr_userpass'] ) && ! is_null ( $this->requests ['cr_userpass'] )) {
				$user->set_password ( $this->requests ['cr_userpass'] );
			}
			$user->_set_email ( $this->requests ['cr_useremail'] );
			$user->_set_name ( $this->requests ['cr_username'] );
			if ($user->_get_lmod () == $this->requests ['cr_userlomd']) {
				try {
					$user->update_user ();
					$this->smarty->assign ( 'message', self::MESSAGE_SUCC, true );
				} catch ( Exception $e ) {
					$this->smarty->assign ( 'message', self::MESSAGE_FAIL, true );
				}
			} else {
				$this->smarty->assign ( 'message', self::MESSAGE_FAIL, true );
			}
		} else {
			$this->smarty->assign ( 'message', self::MESSAGE_INFO, true );
		}
		
		$cols = array (
				'idcr_user',
				'cr_username',
				'cr_useremail',
				'cr_userlomd' 
		);
		$db->where ( "idcr_user", $this->requests ['idcr_user'] );
		$r = $db->getOne ( 'cr_user', null, $cols );
		/**
		 * TODO: Move query to a user list class in modulers.
		 */
		$this->smarty->assign ( 'idcr_user', $r ['idcr_user'], true );
		$this->smarty->assign ( 'cr_username', $r ['cr_username'], true );
		$this->smarty->assign ( 'cr_useremail', $r ['cr_useremail'], true );
		$this->smarty->assign ( 'cr_userpass', $r ['cr_userpass'], true );
		$this->smarty->assign ( 'cr_userlomd', $r ['cr_userlomd'], true );
		
		$this->smarty->display ( $this->template );
	}
}