<?php
/***
 * 解析出字典信息
 * @param string $path
 * @return string
 */
 function uncompress($path = null)
{
	ob_start();
	readgzfile($path);
	$result = ob_get_clean();
	return $result;
}
/***
 * 获得解释信息
 * @param  $path
 * @param  $offset
 * @param  $length
 * @return string
 */
function getInfo($path,$offset,$length){
	$retult=uncompress($path);
	return substr($retult, $offset,$length);
	
}