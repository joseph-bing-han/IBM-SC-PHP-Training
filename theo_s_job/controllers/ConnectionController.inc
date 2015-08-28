<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AbstractRedisController.inc';
class ConnectionController extends AbstractRedisController {
	const TEMPLATE_URI = ''; // no smartty needed, as only json response.
	const ROUTER_ID = 3;
	const TIME_OUT = 29;
	const SLEEPTIME = 100; //micro seconds, 0.1 second
	public function run() {
		$time_start = time ();
		$c_id = SecUser::_get_instance ( null )->_get_user ()->_get_id ();
		$my_pool = "user{$c_id}:messages";
		$message_response = array ();
		// run a thread on server side for TIME_OUT seconds.
		
		while ( (time () - $time_start) < self::TIME_OUT ) {
			
			while ( $this->redis_client->executeRaw ( array (
					'LLEN',
					$my_pool 
			) ) > 0 ) {
				$result = $this->redis_client->executeRaw ( array (
						'LPOP',
						$my_pool 
				) );
				$message_response [] = stripcslashes ( $result );
			}
			
			if (count ( $message_response ) > 0) {
				echo json_encode ( $message_response );
				return;
			}
			
			usleep  ( self::SLEEPTIME ); // improve performance
		}
		
		echo json_encode ( array (
				'TIMEOUT' 
		) );
	}
	protected function get_timeout() {
		return self::TIME_OUT;
	}
}