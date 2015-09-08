<?php
while(true){
$indexPath = null;
$dictPath = null;
echo "选择词典类型(1/2/3):\n";
echo "1. 高级汉语大词典\n";
echo "2. 牛津高阶英汉双解\n";
echo "3. 简明汉英词典\n";
fscanf(STDIN,"%s",$dictType);
if($dictType == "1"){
	$indexPath = 'stardict-gaojihanyudacidian_fix-2.4.2/gaojihanyudacidian_fix.idx';
	$dictPath = 'stardict-gaojihanyudacidian_fix-2.4.2/gaojihanyudacidian_fix.dict';
}else if($dictType == "2"){
	$indexPath = 'stardict-oald-cn-2.4.2/oald_cn.idx';
	$dictPath = 'stardict-oald-cn-2.4.2/oald_cn.dict';
}else if($dictType == "3"){
	$indexPath = 'stardict-powerword2011_1_901-2.4.2/powerword2011_1_901.idx';
	$dictPath = 'stardict-powerword2011_1_901-2.4.2/powerword2011_1_901.dict';
}
$tempval = "";
$fp = fopen ( $indexPath, "rb" );
if (! $fp) {
	echo 'Could not open file somefile.txt';
}
echo "请输入查询单词:\n";
fscanf(STDIN,"%s",$word);
echo "正在查询，请稍后...\n";
$flag = "";
while ( true ) {
	if (feof ( $fp )) {
		break;
	}
	$temp = fgetc ( $fp );
	if ($temp == "\0") {
		
		$offset = sprintf ( "%u", array_shift ( @unpack ( "N", fread ( $fp, 4 ) ) ) );
		$length = sprintf ( "%u", array_shift ( @unpack ( "N", fread ( $fp, 4 ) ) ) );
		if($word==$tempval){
			$flag = "search";
			$fp = fopen ($dictPath, "rb" );
			if (! $fp) {
				echo 'Could not open file somefile.txt';
			}
			
			fseek($fp,$offset);
			$content=fread($fp, $length);
			echo $content;
			
		}
		
		$tempval = "";
		
	} else {
		$tempval = $tempval . $temp;
	}
}
if($flag != "search"){
	echo "无查询结果";
}
fclose ( $fp );

}

 