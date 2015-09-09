<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/libs/db/MysqliDb.php';
class Subscribers{
	protected $data;
	
	public function __construct(){
		$db = MysqliDb::getInstance ();
		$query = 'select idcr_user from cr_user';
		$r = $db->rawQuery($query);
		foreach ($r as $v){
			$this->data[] = $v['idcr_user'];
		}
	}
	
	public function get_subscriber_id_list(){
		return $this->data;
	}
}