<?php
interface UserInterface{
	/**
	 * @return int
	 */
	public function _get_id();
	/**
	 * @return string
	 */
	public function _get_email();
	/**
	 * @return string
	 */
	public function _get_name();
	/**
	 * 
	 * @param string $e
	 * @return UserInterface
	 */
	public function _set_email($e);
	/**
	 * 
	 * @param int $id
	 * @return UserInterface
	 */
	public function _set_id($id);
	/**
	 * 
	 * @param string $name
	 * @return UserInterface
	 */
	public function _set_name($name);
	/**
	 * 
	 * @param string $time
	 * @return UserInterface
	 */
	public function _set_lmod($time);
	/**
	 * @return string
	 */
	public function _get_lmod();
	/**
	 * @return string
	 */
	public function _get_passhash();
	/**
	 * 
	 * @param UserInterface $email
	 */
	public function init_by_email($email);
	/**
	 * Update user data to database;
	 * @return UserInterface
	 */
	public function update_user();
	/**
	 * Add new user to database;
	 * @return UserInterface
	 */
	public function add_user();
	/**
	 * 
	 * @param string $pass
	 * @return UserInterface
	 */
	public function set_password($pass);
	/**
	 * 
	 * @param string $pass
	 * @return string
	 */
	public function hash_gen($pass);
}