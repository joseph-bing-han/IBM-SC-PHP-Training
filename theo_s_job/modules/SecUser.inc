<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/SecUserInterface.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/SecUserException.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/User.inc';
class SecUser implements SecUserInterface {
	private static $ins;
	private $user;
	
	/**
	 *
	 * @param string $str        	
	 * @return boolean
	 */
	public function _hasaccessto($str) {
	}
	protected static function is_logined() {
		if (isset ( $_SESSION ['email'] )) {
			return true;
		}
		return false;
	}
	/**
	 * 
	 * @param string $email
	 * @throws SecUserException
	 * @return SecUser
	 */
	public static function _get_instance($email = null) {
		
		if (is_null ( $email )) {
			@session_start ();
			if (self::is_logined ()) {
				$email = $_SESSION ['email'];
			} else {
				throw new SecUserException ( 'Please login', SecUserException::ERROR_NOT_LOGIN );
			}
		}
		
		if (! isset ( self::$ins ) || self::$ins->_get_user ()->_get_email () != $email) {
			self::$ins = new SecUser ( $email );
		}
		return self::$ins;
	}
	/**
	 * (non-PHPdoc)
	 * @see SecUserInterface::_auth()
	 */
	public function _auth($password) {
		if ($this->user->hash_gen ( $password ) == $this->user->_get_passhash ()) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 
	 * @param string $email
	 */
	private function __construct($email) {
		$this->user = new User ();
		$this->user->init_by_email ( $email );
	}
	private function __clone() {
		// never use clone to create instance
	}
	/**
	 * (non-PHPdoc)
	 * @see SecUserInterface::has_ins()
	 */
	public function has_ins() {
		if (isset ( self::$ins ) && self::$ins instanceof SecUser) {
			return true;
		}
		
		return false;
	}
	/**
	 *
	 * @return User
	 */
	public function _get_user() {
		return $this->user;
	}
}