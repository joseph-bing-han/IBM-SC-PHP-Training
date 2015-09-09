<?php
class Config {
	public static $db_mysql = array (
			'host' => 'localhost',
			'user' => 'root',
			'password' => '',
			'database' => 'chatroom' 
	);
	public static $db_redis = array (
			'host' => '127.0.0.1',
			'port' => 6379,
			'database' => 15,
			'async_connect' => true 
	);
}