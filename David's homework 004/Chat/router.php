<?php
include_once $_SERVER['DOCUMENT_ROOT']."/Chat/config/class.inc";
session_start();

if(isset($_POST['submit'])){
	$s = new scsLogin();
	if($s->validator($_POST)){
		$s->redirector();
	}
}
elseif (isset($_POST['register'])){
	$s = new scsLogin();
	if($s->register($_POST)){
		$s->redirector();
	}else{
		header("Location: /Chat/index.php");
	}
}
elseif (isset($_POST['action']) && $_POST['action'] == 'save'){

	$r = new ChatRoom();
	if($r->pushMsg($_POST)){
		echo 'Save successful';
	}else{
		echo 'Save failed';
	}

}
?>
