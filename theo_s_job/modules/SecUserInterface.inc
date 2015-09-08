<?php
interface SecUserInterface {
	/**
	 *
	 * @param string $str        	
	 * @return boolean
	 */
	public function _hasaccessto($str);
	/**
	 *       	
	 * @param string $password        	
	 * @return boolean
	 */
	public function _auth($password);
	/**
	 *
	 * @param string $email        	
	 * @return SecUserInterface
	 */
	public static function _get_instance($email);
	
	/**
	 * @return boolean
	 */
	public function has_ins();
}