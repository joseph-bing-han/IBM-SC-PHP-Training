<?php
require_once("./db/db.class.php");
$str="";
//过期的用户将其数据删除。

$list = db::getdb()->getUserSession();
if($list)
for($i=0,$k=count($list);$i<$k;$i++)
$str .= $list[$i]['userid']."<br />";
echo $str;
