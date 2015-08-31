<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/controllers/AbstractRedisController.inc';
class ConnectionController extends AbstractRedisController {
	const TEMPLATE_URI = ''; // no smartty needed, as only json response.
	const ROUTER_ID = 3;
	const TIME_OUT = 29;
	const SLEEPTIME = 10; // micro seconds, 0.01 second
	const TEXT_SYSTEM_MESSAGE = 'SYSTEM MESSAGE';
	const TEXT_TIMEOUT_MESSAGE = 'TIMEOUT';
	private $my_pool;
	private $message_response;
	private $subscribers;
	private $c_id;
	/**
	 * (non-PHPdoc)
	 *
	 * @see ControllerInterface::run()
	 */
	public function run() {
		// init for current run
		$time_start = time ();
		$this->c_id = SecUser::_get_instance ()->_get_user ()->_get_id ();
		$this->my_pool = "user{$this->c_id}:messages";
		$this->message_response = array ();
		$sbuscribers = new Subscribers ();
		$this->subscribers = $sbuscribers->get_subscriber_id_list ();
		
		$this->refersh_status_time ();
		
		// run a thread on server side for TIME_OUT seconds.
		while ( (time () - $time_start) < self::TIME_OUT ) {
			
			$this->forward_message ();
			
			$this->checkstatus ();
			
			if (count ( $this->message_response ) > 0) {
				echo json_encode ( $this->message_response );
				return;
			}
			
			usleep ( self::SLEEPTIME ); // improve performance
		}
		
		echo json_encode ( array (
				self::TEXT_TIMEOUT_MESSAGE 
		) );
	}
	/**
	 * (non-PHPdoc)
	 *
	 * @see AbstractRedisController::get_timeout()
	 */
	protected function get_timeout() {
		return self::TIME_OUT;
	}
	/**
	 * Forward message to front end
	 */
	private function forward_message() {
		while ( $this->redis_client->executeRaw ( array (
				'LLEN',
				$this->my_pool 
		) ) > 0 ) {
			$result = $this->redis_client->executeRaw ( array (
					'LPOP',
					$this->my_pool 
			) );
			$this->message_response [] = stripcslashes ( $result );
		}
	}
	/**
	 * check the other users' online status
	 */
	private function checkstatus() {
		foreach ( $this->subscribers as $v ) {
			if ($this->c_id != $v) { // Only check other users
				$result = $this->redis_client->executeRaw ( array (
						'HGET',
						'user' . $v,
						'sub' . $this->c_id 
				) );
				
				if ($result != null && time () - ( int ) $result > self::TIME_OUT) {
					$user = new User ();
					$user->init_by_id ( $v );
					
					$message = new Message ();
					$message->load_by_array ( array (
							$user->_get_name () . ' is offline',
							self::TEXT_SYSTEM_MESSAGE,
							date ( "F j, Y, g:i a" ) 
					) );
					
					$this->message_response [] = json_encode ( $message->jsonSerialize () );
					
					$this->redis_client->executeRaw ( array (
							'HDEL',
							'user' . $v,
							'sub' . $this->c_id
					) );
				}
			}
		}
	}
	/**
	 * Refersh online status for current user
	 */
	private function refersh_status_time() {
		foreach ( $this->subscribers as $v ) {
			if ($v == $this->c_id) {
				continue;
			}
			$result = $this->redis_client->executeRaw ( array (
					'HSET',
					'user' . $this->c_id,
					'sub' . $v,
					time () 
			) );
		}
	}
}