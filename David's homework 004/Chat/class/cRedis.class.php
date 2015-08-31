<?php
class CRedis extends Redis{
	/**
	 * connect to server
	 */
	function __construct(){
		parent::connect("127.0.0.1","6379");
	}
	/**
	 * get online user
	 * @return Array:
	 */
	public function getOnlineUser(){

		$useridStr = $this->get('userid');
		$useridArr = explode(',', $useridStr);
		foreach ($useridArr as $k => $v ){
			if(!json_decode($this->get($v.'_on'))){
				unset($useridArr[$k]);
			}
		}
		return $useridArr;
	}
	/**
	 *
	 * @param int $userId
	 * @return Array
	 */
	public function getMyMsg($userId){
		$currentUserDb = $userId.'_on';

		$msg = '';
		if($onlineMsg = json_decode($this->get($currentUserDb), true)){
			foreach ($onlineMsg as $k => $v){
				if($k == 'time'){
					//echo $v.'<br />';
				}elseif ($k=='msg' && count($v) > 0){
					$msg = $v;
				}
			}
		}
		$this->set($currentUserDb, json_encode(array('time'=>date('Y-m-d H:i:s'), 'msg'=>array())));//update  current user online time

		return $msg;
	}
	/**
	 * validate user is on online
	 * @return Array:
	 */
	public function validateOnlineUser(){

		$useridStr = $this->get('userid');
		$useridArr = explode(',', $useridStr);
		foreach ($useridArr as $k => $v ){
			if($online = json_decode($this->get($v.'_on'), true)){
				if(strtotime(date('Y-m-d H:i:s')) - strtotime($online['time']) > 2){
					$this->delete($v.'_on');
				}
			}
		}

	}
}
