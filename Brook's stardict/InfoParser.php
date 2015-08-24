<?php
/**
 * 获得详细信息
 * @author litz
 *
 */
class InfoParse{
	static function parse($fileName) {
		$word=""; // 词典名称
		$fp = fopen ( $fileName, "r" );
		if (! $fp) {
			die ( "打开文件" . fileName . "失败！" );
		}
		while (!feof($fp)) { //
			$char = fgets ( $fp );
			if(!(strpos($char, "bookname=")===false)){
				$index=strpos($char, "=");
				$word=substr($char, $index+1);
			}
		}
			fclose($fp);
			return $word;
	}
}