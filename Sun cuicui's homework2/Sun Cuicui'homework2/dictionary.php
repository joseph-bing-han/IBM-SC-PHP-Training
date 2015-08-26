<?php
class dictionary{
// 	获取字典文件路径
	public function get_dir(){
		$get_dir=dirname(__FILE__)."/files";
		if($dir = opendir($get_dir)){//List files 
		while (! false==($file = readdir($dir)) )
		{
			if(end(explode('.',$file))=='idx'){	
				$this->dirfiles[] = $file;
		    }
		}
		}
	    return $this->dirfiles;
	    }
   
   //解析字典文件，多维数组存放单词的偏移量、长度和dict文件名
   public function __construct(){
   	echo 'Waiting for a moment......';
   	$filenames = $this->get_dir();
   	$i = 0;
   	foreach ($filenames as $filename) {
   		$fp = fopen(dirname(__FILE__).'\files\\'.$filename, "r");
   		$word = '';
   		if($fp){
   			while(!feof($fp)) {
   				$buffer = fgetc($fp);
   				if( $buffer == "\0" ){
   					$this->words[$i][$word]['begin'] =  sprintf("%u", array_shift(@unpack("N",fread($fp, 4))));
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
   		$i++;
   		fclose($fp);
   	}
   
   	echo "\n";
   }
   //获得输入单词的详细信息
   public function execute($word){
   	$result = array();
   
   	foreach($this->words as $dictory){

   		if(array_key_exists($word, $dictory)){
   			//$filename = $this->get_dict();
   			$filename = $dictory[$word]["dic"];
   			$fp = fopen(dirname(__FILE__).'\files\\'.$filename, "rb" );
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
    
}