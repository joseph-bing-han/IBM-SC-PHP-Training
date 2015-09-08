<?php

require "class/chat.class.php";
require "class/mysql.class.php";

error_reporting(E_ALL ^ E_NOTICE);


session_name('webchat');
session_start();

if(get_magic_quotes_gpc()){

	array_walk_recursive($_GET,create_function('&$v,$k','$v = stripslashes($v);'));
	array_walk_recursive($_POST,create_function('&$v,$k','$v = stripslashes($v);'));
}

try{
	
	$response = array();
	
	switch($_GET['action']){
		
		case 'checkLogged':
			$response = Chat::checkLogged();
		break;

		case 'checkUser':
			$response = Chat::checkUser($_POST['userid'],$_POST['pass']);
		break;
		
		case 'logout':
			$response = Chat::logout();
		break;
		
		case 'submitChat':
			$response = Chat::submitChat($_POST['chatText']);
		break;
		
		case 'getUsers':
			$response = Chat::getUsers();
		break;
		
		case 'getChats':
			$response = Chat::getChats($_GET['lastID']);
		break;

		case 'insertActive';
			$response = Chat::insertActive($_POST['userid']);
		break;

		case 'checkExist':
			$response = Chat::checkExist($_POST['userid']);
		break;

		case 'reg':
			$response = Chat::regist($_POST['userid'],$_POST['pass']);
		break;
		
		default:
			throw new Exception('Wrong action');
	}
	
	echo json_encode($response);
}
catch(Exception $e){
	die(json_encode(array('error' => $e->getMessage())));
}

?>