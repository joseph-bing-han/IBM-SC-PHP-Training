<?php
/******
*全局配置文件
*author 李天中
*/
/***
 * config route
 */
$CONFIG ['system'] ['route'] = array (
		'default_controller' => 'home', // 默认控制器
		'default_action' => 'index', // 默认方法
		'url_type' => 2          /*解析url方式
								  *1 普通模式   index.php?c=controller&a=action&id=2
								  *2 PATHINFO   index.php/controller/action/id/2
                                  */
);
/***
 * config database
 */
$CONFIG ['system'] ['db'] = array (
		'host' => 'localhost', // database ip
		'user' => 'root', //  database user
		'password' => '123',
		'db'=>'testdb'   
);
?>