<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/MessagerController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/RegisterController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/LoginController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/ConnectionController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/ControllerException.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/SendMessageController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AdminController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AdminUpdateUController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/DeleteUserController.inc';

class ControllerRouter {
	protected $router_map;
	public function __construct() {
		$this->router_map = array (
				RegisterController::ROUTER_ID => 'RegisterController',
				MessagerController::ROUTER_ID => 'MessagerController',
				LoginController::ROUTER_ID => 'LoginController',
				ConnectionController::ROUTER_ID => 'ConnectionController',
				SendMessageController::ROUTER_ID => 'SendMessageController',
				AdminController::ROUTER_ID => 'AdminController',
				AdminUpdateUController::ROUTER_ID => 'AdminUpdateUController',
				DeleteUserController::ROUTER_ID => 'DeleteUserController'
		);
	}
	/**
	 * 
	 * @param int $router_id
	 * @throws ControllerException
	 */
	public function dispatch($router_id) {
		if (! is_numeric ( $router_id )) {
			throw new ControllerException ( 'wrong router id is applied.' );
		}
		
		if(! key_exists($router_id, $this->router_map)){
			throw new ControllerException ( 'undefined controller' );
		}
		
		$class_name = $this->router_map [$router_id];
		
		$class = new ReflectionClass ( $class_name );
		
		try {
			$controller = $class->newInstance ();
		} catch ( SecUserException $e ) {
			if ($e->getCode () == SecUserException::ERROR_NOT_LOGIN) {
				$this->dispatch ( LoginController::ROUTER_ID );
				return;
			}
		}

		if ($controller instanceof ControllerInterface) {
			$controller->run ();
		} else {
			throw new ControllerException ( 'Controller not implements ControllerInterface' );
		}
	}
}