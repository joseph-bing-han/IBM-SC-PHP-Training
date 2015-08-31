<?php
require_once("./db/db.class.php");
//删除超时在线用户
db::getdb()->deleteOverTimeUser();
$str="";
$list = db::getdb()->getlts();
if($list)
for($i=0,$k=count($list);$i<$k;$i++)
$str .= "<span style='background:#ccc;color:#f0f'>用户名:{$list[$i]['user']} | 时间:".date("Y-m-d H:i:s",$list[$i]['addtime'])."</span><br />".$list[$i]['content']."<br />";
echo $str;
