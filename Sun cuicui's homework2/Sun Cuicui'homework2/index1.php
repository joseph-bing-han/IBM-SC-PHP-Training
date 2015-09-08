<?php
include_once'dictionary.php';
$find =new dictionary();
while(true){
	//fwrite(STDOUT,"Please input a Word(If you want quit please type 'q'):");
	echo "---------欢迎来到牛津大词典----------\n请输入单词：";
	$arg = trim(fgets(STDIN));
	$find->execute($arg);
	}

