<?php
class AbstractMessage implements JsonSerializable {
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
	
	abstract public function jsonSerialize();
	abstract public function jsonLoad();
}