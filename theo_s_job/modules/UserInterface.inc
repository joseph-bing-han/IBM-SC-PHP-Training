<?php
interface UserInterface{
	public function _get_id();
	public function _get_email();
	public function _get_name();
	public function _set_email($e);
	public function _set_id($id);
	public function _set_name($name);
	public function _set_lmod($time);
	public function _get_lmod();
	public function _get_passhash();
	
	public function init_by_email($email);
	public function update_user();
	public function add_user();
	public function set_password($pass);
	public function hash_gen($pass);
}