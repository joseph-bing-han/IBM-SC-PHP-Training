<?php
  //error_reporting(E_ALL);
  include_once(dirname(__FILE__).'\readdict.php');


  $find = readdict::getInstance();


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