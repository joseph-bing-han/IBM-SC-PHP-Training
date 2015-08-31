<?php
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/UserInterface.inc';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/libs/db/MysqliDb.php';
include_once $_SERVER ['DOCUMENT_ROOT'] . '/IBM-SC-PHP-Training/theo_s_job/modules/UserException.inc';
class User implements UserInterface {
	protected $_name;
	protected $_id;
	protected $_email;
	protected $_passhash;
	protected $_lmod;
	const salt = 'life is like a box of chocolates'; // To mix data for MD5
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_get_email()
	 */
	public function _get_email() {
		return $this->_email;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_get_id()
	 */
	public function _get_id() {
		return $this->_id;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_get_name()
	 */
	public function _get_name() {
		return $this->_name;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_set_email()
	 */
	public function _set_email($e) {
		$this->_email = $e;
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_set_id()
	 */
	public function _set_id($id) {
		$this->_id = $id;
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_set_name()
	 */
	public function _set_name($name) {
		$this->_name = $name;
		return $this;
	}
	/**
	 *
	 * @param unknown $hash        	
	 * @return User
	 */
	protected function _set_passhash($hash) {
		$this->_passhash = $hash;
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_get_passhash()
	 */
	public function _get_passhash() {
		return $this->_passhash;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::set_password()
	 */
	public function set_password($pass) {
		$this->_set_passhash ( $this->hash_gen ( $pass ) );
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::hash_gen()
	 */
	public function hash_gen($pass) {
		return md5 ( $pass . self::salt );
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_set_lmod()
	 */
	public function _set_lmod($time) {
		$this->_lmod = $time;
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::_get_lmod()
	 */
	public function _get_lmod() {
		return $this->_lmod;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::add_user()
	 */
	public function add_user() {
		$db = MysqliDb::getInstance ();
		try {
			
			if ($this->_get_name () && $this->_get_email () && $this->_get_passhash ()) {
				$r = $db->insert ( 'cr_user', array (
						'cr_username' => $this->_get_name (),
						'cr_useremail' => $this->_get_email (),
						'cr_userpass' => $this->_get_passhash (),
						'cr_userlomd' => $db->now () 
				) );
			} else {
				throw new UserException ( 'User information is not completed.' );
				return $this;
			}
		} catch ( Exception $e ) {
			throw new UserException ( $e->getMessage () );
			return $this;
		}
		
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::update_user()
	 */
	public function update_user() {
		$db = MysqliDb::getInstance ();
		
		try {
			$db->where ( 'idcr_user', $this->_id );
			$db->update ( 'cr_user', array (
					'cr_username' => $this->_get_name (),
					'cr_useremail' => $this->_get_email (),
					'cr_userlomd' => $db->now () ,
					'cr_userpass' => $this->_get_passhash()
			) );
		} catch ( Exception $e ) {
			throw new UserException ( $e->getMessage () );
		}
		
		return $this;
	}
	/**
	 * (non-PHPdoc)
	 * 
	 * @see UserInterface::init_by_email()
	 */
	public function init_by_email($email) {
		$db = MysqliDb::getInstance ();
		$query = 'select * from cr_user where cr_useremail ="' . $email . '"';
		$r = $db->rawQuery ( $query );
		if (count ( $r ) == 0) {
			throw new UserException ( 'Email is not existing registered' );
			return $this;
		}
		foreach ( $r as $v ) {
			$this->_set_email ( $v ['cr_useremail'] );
			$this->_set_name ( $v ['cr_username'] );
			$this->_set_passhash ( $v ['cr_userpass'] );
			$this->_set_lmod ( $v ['cr_userlomd'] );
			$this->_set_id ( $v ['idcr_user'] );
		}
		
		return $this;
	}
	
	public function init_by_id($id){
		
		if(!is_numeric($id)){
			throw new UserException ( 'ID is not a number assigned' );
			return $this;
		}
		
		$db = MysqliDb::getInstance ();
		$query = 'select * from cr_user where idcr_user ="' . $id . '"';
		$r = $db->rawQuery ( $query );
		if (count ( $r ) == 0) {
			throw new UserException ( 'ID is not existing in database' );
			return $this;
		}
		foreach ( $r as $v ) {
			$this->_set_email ( $v ['cr_useremail'] );
			$this->_set_name ( $v ['cr_username'] );
			$this->_set_passhash ( $v ['cr_userpass'] );
			$this->_set_lmod ( $v ['cr_userlomd'] );
			$this->_set_id ( $v ['idcr_user'] );
		}
		
		return $this;
	}
	
	public function delete(){
		if(!is_numeric($this->_get_id())){
			throw new UserException ( 'ID is not a number assigned' );
			return $this;
		}
		$db = MysqliDb::getInstance ();
		$db->where('idcr_user', $this->_get_id());
		if(!$db->delete('cr_user')){
			throw new UserException('Delte failed');
		}
		
		return $this;
	}
}