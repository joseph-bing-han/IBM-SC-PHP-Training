<?php
require_once("./db/db.class.php");
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
$username = $_POST['username'];
$password = $_POST['password']; 
$result = db::getdb()->login($username, $password);
if(count($result)==1){
	echo "<script> parent.location.href='index.html?username=".$username."'; </script>"; 
}else {
	echo "<script> alert('login fail');parent.location.href='Login.html'; </script>"; 
}
