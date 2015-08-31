<?php
// 公共聊天窗口页面处理
require_once 'Mysql.php';
$db= new Mysql("localhost:3306","root","scc880811","factory");
// $db->myrefresh(center.php);
    $select = $db->selectall("message");
    $row = $db->num($select);
        	for($i=0;$i<$row;$i++){
        		$result_arr=$db->Myarray($select);
        		$username=$result_arr['username'];
        		$data=$result_arr['data'];
        echo "<tr><td>$username.:</td><td>$data</td><tr>";
    }
    
//     }
//  }else{
//         echo "查不到任何数据!";
//     }
     
    $db->CloseDb();

?>