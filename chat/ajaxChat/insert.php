<?php
require_once("./db/db.class.php");
if($_GET['user'] && $_GET['say']){
	$user=$_GET['user'];
	$say=$_GET['say'];
	$time = time();	
	db::getdb()->insertlts($say,$user,$time);
}
