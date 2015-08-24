<?php
/****
 * index文件的解析
 * @author 李天中
 *
 */
class IdxParser {
	/***
	 * 文件解析
	 * @param  $fileName
	 * @return multitype:multitype:number
	 */
	static function parse($fileName) {
		$word=""; // 单词
		$offset=0; // 偏移量
		$length=0; // 长度
		$dictArray=array();//数组
		$fp = fopen ( $fileName, "rb" );
		if (! $fp) {
			die ( "打开文件" . fileName . "失败！" );
		}
		while (!feof($fp)) { // 
			$char = fgetc ( $fp );
			if ($char == "\0") {
				$offset = array_shift(@unpack ( "N", fread ( $fp, 4 ) ));
				$length = array_shift(@unpack ( "N", fread ( $fp, 4 ) ));
				$dictArray[$word] = array (
						"offset" => $offset,
						"length" => $length 
				);
				$word="";
			} else { // 拼接单词
				$word .= $char;
			}
		}
		fclose($fp);
		return $dictArray;
	}
	/**
	 * 获得信息
	 * @param  $word
	 */

	static function getIdx($word){
		GLOBAL $dictArray;
		$idxArray=array();
		$i=0;
		foreach ($dictArray as $value){
			if(@$value["idx"][$word]){//处理信息
				$idxArray[$i]=array("file"=>$value["file"],"idx"=>$value["idx"][$word],"ifo"=>$value["ifo"]);
			}
			$i++;
		}
		return $idxArray;
	}
}