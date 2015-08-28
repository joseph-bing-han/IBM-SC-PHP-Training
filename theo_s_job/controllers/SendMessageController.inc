<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AbstractRedisController.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/Subscribers.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/Message.inc';
class SendMessageController extends AbstractRedisController {
	const TEMPLATE_URI = ''; // no smartty needed, as only json response.
	const ROUTER_ID = 4;
	const TIME_OUT = 10;
	public function run() {
		if (! isset ( $this->requests ['load'] ) || ! isset($this->requests ['email'])) {
			return;
		}
		
		$message = new Message ();
		$message->load_by_array ( array (
				$this->requests ['load'],
				SecUser::_get_instance ( $this->requests ['email'] )->_get_user ()->_get_name (),
				date ( "F j, Y, g:i a" ) 
		) );
		
		var_dump ( json_encode ( $message->jsonSerialize () ) );
		
		$sbuscribers = new Subscribers ();
		$l = $sbuscribers->get_subscriber_id_list ();
		foreach ( $l as $v ) {
			$r = $this->redis_client->executeRaw ( array (
					'RPUSH',
					"user{$v}:messages",
					addslashes ( json_encode ( $message->jsonSerialize () ) ) 
			) );
		}
	}
	protected function get_timeout() {
		return self::TIME_OUT;
	}
}