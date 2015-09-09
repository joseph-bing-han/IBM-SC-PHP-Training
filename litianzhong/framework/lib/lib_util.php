<?php
/**
 * @Auth: 李天中
 * Class Util
 * @package 
 */
class Util {
	public static function _post($key) {
		return isset ( $_POST [$key] ) ? $_POST [$key] : '';
	}
	public static function _get($key) {
		return isset ( $_GET [$key] ) ? $_GET [$key] : '';
	}
}
