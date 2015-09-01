<?php
require "cache.php";
class cornController extends Controller {
	const sleeptime = 1;
	const exp = 30;
	public function __construct() {
		parent::__construct ();
	}
	/***
	 * 查询数据信息
	 */
	public function corntable() {
		session_write_close ();
		register_shutdown_function(array('chatController','flush'));
		while ( true ) {
			$model = $this->model ( "corn" ); // 获得model
			if ($model->selectStateCount ( self::exp ) > 0) {
				$model->updateLogin ( self::exp );
				$model->updateNotice ();
			}
			sleep ( self::sleeptime ); // sleep time
		}
	}
	/***
	 * set data
	 */
	static function flush(){
		cache::set ( "__corn", "0" );
	}
}