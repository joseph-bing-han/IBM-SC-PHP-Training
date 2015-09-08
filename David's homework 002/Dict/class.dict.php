<?php 
class dict{
	
	const DICT_DIR = './dict/';
	const FILE_TYPE_IDX = '.idx';
	const FILE_TYPE_DICT = '.dict';
	const FILE_TYPE_IFO = '.ifo';
	
	var $idxArray = array();
	var $dictArray = array();
	var $dictName = array('powerword2011_1_901','gaojihanyudacidian_fix','oald_cn');

	var $debug_flag = false;
	
	/**
	 * __construct
	 */
	function __construct(){
		echo '>>>>Loading>>>>>>';
		$this->init();
	}
	/**
	 * Get file full path 
	 * @param String $fileName
	 * @param String $fileType
	 */
	private function getFilePath($fileName, $fileType){
		return self::DICT_DIR.$fileName.$fileType;
	}
	/**
	 * Get parser for index files
	 * @param String $fileName
	 * 
	 */
	private function parseIdxfile($fileName){
		
		$idxFilePath = $this->getFilePath($fileName, self::FILE_TYPE_IDX);
		if(!file_exists($idxFilePath)){
			echo "$idxFilePath does not exist!";
			exit;
		}
		$fp = fopen($idxFilePath, 'rb');
		$tempval = $offset = $length = '';
		while ( true ) {
			if (feof ( $fp )) {
				if($fp) fclose($fp);
				break;
			}
			$temp = fgetc ( $fp );
			if ($temp == "\0") {
				if($this->debug_flag)
					echo $tempval . "\n";
				
				$offset = array_shift ( @unpack ( "N", fread ( $fp, 4 ) ) ) ;
				$length = array_shift ( @unpack ( "N", fread ( $fp, 4 ) ) ) ;
				if($this->debug_flag){
					echo $offset . "\n";
					echo $length . "\n";
				}
				$this->idxArray[$tempval]=array('offset'=>$offset, 'length'=>$length); 
				$tempval = "";
			} else {
				$tempval = $tempval . $temp;
			}
		}
	}
	/**
	 * Get parser for Dict files
	 * @param String $fileName
	 * @return boolean
	 */
	private function parseDict($fileName){
		$dictFilePath = $this->getFilePath($fileName, self::FILE_TYPE_DICT);
		if(!file_exists($dictFilePath)){
			echo "$dictFilePath does not exist!";
			exit;
		}
		$fpDict = fopen ($dictFilePath, "r" );
		
		$dictName = $this->getDictInfo($fileName);
		
		$this->dictArray[$dictName] = array('dictname'=>$fileName,'dict'=>$fpDict, 'index'=>$this->idxArray);
		if(feof($fpDict)){
			fclose($fpDict);
		}
		return true;
	}
	/**
	 * Get parser for Dict infomation
	 * @param String $fileName
	 */
	private function getDictInfo($fileName){
		
		$infoFilePath = $this->getFilePath($fileName, self::FILE_TYPE_IFO);
		$fp = fopen($infoFilePath, 'r');
		$dictName = '';
		while (!feof($fp)){
			$line = fgets($fp);
			if (preg_match("/bookname=(.*)/", $line, $match)) {
				$dictName = $match[1];
				break;
			}
		}
		
		//echo $dictName;
		if(feof($fp)){
			fclose($fp);
		}
		return $dictName;
	}

	/**
	 * init Dict index file, Dict file, Dict info
	 * 
	 */
	private function init(){
		$i = 1;
		$count = count($this->dictName);
		
		foreach ($this->dictName as $k => $v){
			$this->parseIdxfile($v);
			if ($this->parseDict($v)){
				echo "\n";
				echo 'loading: '.(number_format($i/$count,1)*100).'%';
			}
			$i++;
		}
	}
	/**
	 * Translate the word which you input from CLI
	 * @param string $needle
	 */
	public function translate($needle=''){
		$i = 0;
		foreach ($this->dictArray as $k => $v){
			
			if(isset($v['index'][$needle])){
				
				fseek($v['dict'], $v['index'][$needle]['offset']);
				$content=fread($v['dict'], $v['index'][$needle]['length']);
				if(!empty($content))
				{
					echo "\n================================== ";
					echo $k;
					echo ' ==================================';
					echo "\n".$content;
				}
				
			}
			else{
				$i++;
			}
		}
		if($i==3){
			echo 'Sorry, the word does not exit!';
		}
	}

}
?>