<?php
require_once("./db/db.class.php");
if($_GET['user'] && $_GET['say']){
	$username=$_GET['user'];
	$say=$_GET['say'];
	$time = time();	
	
	//if exist userSession in the table that update datetime
	$isExistSessionName = db::getdb()->getSessionUserName($username);
	if($isExistSessionName){
		//update time
		$time = time();
		db::getdb()->updateSessionDate($username, $time);
	}else{
		$time = time();
		db::getdb()->addActivityUser($username,$time);
	}
	db::getdb()->insertlts($say,$username,$time);
}
