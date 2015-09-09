<?php
class cornModel extends Model {
	/***
	 * update expired 
	 * @param int $time
	 */
	public function updateLogin($time){
		$sql="update session set flag='0' where CURRENT_TIMESTAMP-time>? and flag='1'";
		$this->db->execute($sql,array($time));
	}
	/***
	 * select expired
	 * @param int $time
	 */
	public function selectStateCount ($time){
		$sql="select  count(1) from session where CURRENT_TIMESTAMP-time>? and flag='1'";
		return $this->db->valueQuery($sql,array($time));
	}
	/***
	 * notcie others
	 * @param unknown $time
	 */
	public function updateNotice (){
		$sql="update session set state='1' where flag='1' and 1=?";
		return $this->db->execute($sql,array(1));
	}
	/***
	 * validate user state
	 * @param int $time
	 */
	public function selectLogin($id){
		$sql="select state from session  where id=?";
		$result=$this->db->valueQuery($sql,array($id));
		return $result;
	}
	/**
	 * update self time
	 * @param String $id
	 */
	public function updateLoginone($id){
		$sql="update session set time=CURRENT_TIMESTAMP where id=?";
		$this->db->execute($sql,array($id));

	}
	/***
	 * update self state
	 * @param string  $id
	 */
	public function updateState($id){
		$sql="update session set state='0' where id=?";
		$this->db->execute($sql,array($id));
	
	}
	/**
	 * select user list
	 */
	public function selectUsers(){
		$sql="select id,name from session where flag='1'";
		return $this->db->rawQuery($sql);
	
	}
	/***
	 * logout
	 * @param String $id
	 */
	public function logout($id){
		$sql="update session set flag='0' where  id=?";
		$this->db->execute($sql,array($id));
	}
	/**
	 * 更新控制表
	 */
	public function updateChatctrl(){
		$sql="update chatctrl set state='0' where  1=?";
		$this->db->execute($sql,array(1));
	}
	
}