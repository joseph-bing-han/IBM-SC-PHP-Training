<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/MessageException.inc';
class Message {
	protected  $_body;
	protected  $_from;
	protected  $_time;
	public function _get_from_user_name() {
		return $this->_from;
	}
	public function _get_message_body() {
		return $this->_body;
	}
	public function _get_time() {
		return $this->_time;
	}
	
	public function load_by_array($array){
		$this->_body = $array[0];
		$this->_from = $array[1];
		$this->_time = $array[2];
	}
	public function jsonSerialize() {
		return array (
				'from' => $this->_get_from_user_name (),
				'body' => $this->_get_message_body (),
				'time' => $this->_get_time () 
		);
	}
	public function jsonLoad($json) {
		$list = json_decode ( $json, TRUE );
		$this->_from = $list ['from'];
		$this->_body = $list ['body'];
		$this->_time = $list ['time'];
	}
}