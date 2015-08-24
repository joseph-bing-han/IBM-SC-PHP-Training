<?php

class readdict{

private static $instance;
private $dictfiles;
private $words;

//follow sugarcrm's style
static public function getInstance(){	
    if (!isset(self::$instance)) {
        self::$instance = new readdict();
    } // if
    return self::$instance;
}

public function execute($word){
	$resault = array();

	foreach($this->words as $key => $dictory){

		if(array_key_exists($word, $dictory)){

			$fp = fopen(dirname(__FILE__)."\dictfiles\\".$dictory[$word]["dic"], "rb" );
			if (! $fp) {
				echo 'Could not open file somefile.txt';
			}

			fseek($fp, $dictory[$word]['begin'] );
			$content = fread( $fp, $dictory[$word]['length'] );
			echo $content;

		}

	}
	echo "\n";

}

public function __construct(){
	echo 'loading dictory,please wait......';

	//header("Content-Type:text/html;charset=utf-8");
	$filenames = $this->getfiles();
	$i = 0;

	foreach ($filenames as $key => $filename) {
		$fp = fopen(dirname(__FILE__).'\dictfiles\\'.$filename, "r");
		$word = '';
		if($fp){
			while(!feof($fp)) {
				$buffer = fgetc($fp);
				if( $buffer == "\0" ){
					$this->words[$i][$word]['begin'] = sprintf("%u", array_shift(@unpack("N",fread($fp, 4))));
					$this->words[$i][$word]['length'] = sprintf("%u", array_shift(@unpack("N",fread($fp, 4))));
					$this->words[$i][$word]['dic'] = substr($filename,0,strrpos($filename, '.')).'.dict';
					$word = "";

				} else {
					$word = $word . $buffer;
				}
			}
		}else{
			echo "can't open the file!";
		}
		$i = $i + 1;
		fclose($fp);
	}
	
	echo "\n";
}

public function getfiles(){
	$dirpath = dirname(__FILE__)."\dictfiles";
	if ($dh = opendir($dirpath)) {
		while (($file = readdir($dh)) !== false){
			if(end(explode('.',$file))=='idx'){
				$this->dictfiles[] = $file;
			}
		}
	}
	return $this->dictfiles;
}

}

?>