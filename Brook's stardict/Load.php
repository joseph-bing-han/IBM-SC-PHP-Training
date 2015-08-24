
<?php
require_once 'IdxParser.php';
require_once 'InfoParser.php';
$dictArray; // 全局信息
$DIC_DIR=dirname(__FILE__)."/dict/";//字典目录
/**
 * ***
 * 加载信息
 *
 * @author 李天中
 *        
 */
class Load {
	function __construct() {
		$this->loadIdx();
	}
	/**
	 * *
	 * 加载索引
	 */
	function loadIdx() {
		GLOBAL $dictArray;
		GLOBAL $DIC_DIR;
		$dictDir = self::getDirList ($DIC_DIR);
		$i = 0;
		foreach ( $dictDir as $value ) {
			$file = self::getFile ( $DIC_DIR . $value );
			$file=$DIC_DIR.$value."/".$file;
			$info=InfoParse::parse(substr($file,0,-4).".ifo");
			$idxArray = IdxParser::parse ( $file );
			$dictArray[$i]=array("file"=>substr($file,0,-4).".dict.dz","idx"=>$idxArray,"ifo"=>$info);
			$i ++;
		}
	}
	
	/**
	 * *
	 * 列出文件
	 *
	 * @param
	 *        	$directory
	 * @return multitype:
	 */
	static function getDirList($directory) {
		$files = array ();
		if (is_dir ( $directory )) {
			if ($files = scandir ( $directory )) {
				$files = array_slice ( $files, 2 );
			}
		}
		return $files;
	}
	/**
	 * *
	 * 获得文件
	 *
	 * @param
	 *        	$dir
	 * @return Ambigous <NULL, string>
	 */
	static function getFile($dir) {
		$idxFile = "";
		if (false != ($handle = opendir ( $dir ))) {
			while ( false !== ($file = readdir ( $handle )) ) {
				if ($file != "." && $file != ".." && strpos ( $file, ".idx" )) {
					$idxFile = $file;
				}
			}
			closedir ( $handle );
		}
		return $idxFile;
	}
}