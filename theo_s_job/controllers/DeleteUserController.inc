<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/MessagerController.inc';
class DeleteUserController extends MessagerController {
	const TEMPLATE_URI = 'delete.html';
	const ROUTER_ID = 7;
	const MESSAGE_DELE = 'User has been deleted';
	const MESSAGE_INVD = 'invalidated user id';
	protected $secuser;
	protected $template;
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	public function run() {
		if(isset($this->requests['idcr_user']) && is_numeric($this->requests['idcr_user'])){
			$user = new User();
			$user->init_by_id($this->requests['idcr_user']);
			$m = self::MESSAGE_DELE;
			try {
				$user->delete();
			}
			catch (UserException $e){
				$m = $e->getMessage();
			}
			
			$this->smarty->assign('message', $m);
		}
		else {
			$this->smarty->assign('message', self::MESSAGE_INVD);
		}
		
		$this->smarty->display($this->template);
	}
}