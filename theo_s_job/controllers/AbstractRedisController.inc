<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/MessagerController.inc';
require_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/libs/predis/src/Autoloader.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/config/Config.inc';

abstract class AbstractRedisController extends AbstractController {
	const TEMPLATE_URI = ''; // no smartty needed, as only json response.
	const ROUTER_ID = - 1;
	const TIME_OUT = 15;
	protected $redis_client;
	public function __construct() {
		parent::__construct ();
		Predis\Autoloader::register ();
		
		$this->setup_client();
	}
	protected function _set_template() {
		$this->template = self::TEMPLATE_URI;
	}
	abstract protected function get_timeout();
	
	protected function setup_client(){
		$single_server = Config::$db_redis;
		$this->redis_client = new Predis\Client ( $single_server + array (
				'read_write_timeout' => $this->get_timeout ()
		) );
	}
	
	protected function rest_client(){
		$this->redis_client->disconnect();
		unset($this->redis_client);
		$this->setup_client();
	}
}