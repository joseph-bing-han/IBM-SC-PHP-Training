<?php
require_once './class.dict.php';


$dict = new dict();
while (true){
	echo "\n请输入要查询的单词,然后回车, <exit> 回车退出:";

	fscanf(STDIN, '%s', $needle);
	if ($needle == '<exit>')
	{
		echo 'game over!';
		break;
	}

	if(!isset($needle) || empty($needle)){
		echo "Sorry, please input word!";
		continue;
	}else {
		$dict->translate($needle);
		echo "\n";
	}
}

?>