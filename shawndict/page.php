<?php
  //error_reporting(E_ALL);
  include_once('C:\PHPapplication\WarmpServer\wamp\www\dict\newfile.php');


  $find = newfile::getInstance();


  while(true){
	fwrite(STDOUT,"Please input a Word(If you want quit please type '-quit'):");
	$arg = trim(fgets(STDIN));
	if($arg == '-quit'){
		break;
	}else{
		$find->execute($arg);
	}
  }

  echo "QUIT"."\n";

?>