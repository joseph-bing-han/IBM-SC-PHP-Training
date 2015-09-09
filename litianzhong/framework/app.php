<?php
/*****
 * app主控程序
 * @author  李天中
 */
define('SYSTEM_PATH', dirname(__FILE__));
define('ROOT_PATH',  substr(SYSTEM_PATH, 0,-10).'/web');
define('SYS_LIB_PATH', SYSTEM_PATH.'/lib');
define('SYS_CORE_PATH', SYSTEM_PATH.'/base');
define('CONTROLLER_PATH', ROOT_PATH.'/controller');
define('MODEL_PATH', ROOT_PATH.'/model');
define('VIEW_PATH', ROOT_PATH.'/view');
define("BASE_URL", '/chat/');
define("STATIC_URL", BASE_URL.'web/');
define('LOG_PATH', substr(SYSTEM_PATH, 0,-10).DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR);
final class Application {
	public static $_lib = null;
	public static $_config = null;
	/***初始化**/
	public static function init() {
		self::setAutoLibs();
		require SYS_CORE_PATH.'/model.php';
		require SYS_CORE_PATH.'/controller.php';

	}
	/**
	 * 运行程序
	 * @access      public
	 * @param       array   $config
	 */
	public static function run($config){
		self::$_config = $config['system'];
		self::init();
		self::autoload();
		self::initLog();
		self::$_lib['route']->setUrlType(self::$_config['route']['url_type']); //url类型
		$url_array = self::$_lib['route']->getUrlArray();                      //获得url类型
		self::route2Controller($url_array);
	}
	/*
	*日志初始化
	*/
	public static function initLog(){
		self::$_lib['LogUtil']->start();
		self::$_lib['LogUtil']->setLogThreshold(0);
		self::$_lib['LogUtil']->log($_SERVER['REQUEST_URI']);
	}
	/**
	 * 自动加载
	 * @access      public
	 * @param       array   $_lib
	 */
	public static function autoload(){
		foreach (self::$_lib as $key => $value){
			require (self::$_lib[$key]);
			$lib = ucfirst($key);
			self::$_lib[$key] = new $lib;
		}
	}
	/**
	 * 加载新的类
	 * @access      public
	 * @param       string  $class_name 
	 * @return      object
	 */
	public static function newLib($class_name){
		$sys_lib = '';
		$sys_lib = SYS_LIB_PATH.'/lib_'.$class_name.'.php';

		if(file_exists($sys_lib)){
			require ($sys_lib);
			return self::$_lib['$class_name'] = new $class_name;
		}else{
			trigger_error('加载'.$class_name.'不存在');
		}
	}
	/**
	 * 自动加载的类库
	 * @access      public
	 */
	public static function setAutoLibs(){
		self::$_lib = array(
				'route'              =>      SYS_LIB_PATH.'/lib_route.php',
				'SessionAuth'              =>      SYS_LIB_PATH.'/lib_SessionAuth.php',
				'util'           =>      SYS_LIB_PATH.'/lib_util.php',
				'LogUtil'	=>			SYS_LIB_PATH.'/lib_log.php',
				'DbKit'	=>			SYS_LIB_PATH.'/lib_DbKit.php'
		);
	}
	/**
	 * 根据URL分发到Controller和Model
	 * @access      public
	 * @param       array   $url_array
	 */
	public static function route2Controller($url_array = array()){
		$app = '';
		$controller = '';
		$action = '';
		$model = '';
		$params = '';

		if(isset($url_array['app'])){
			$app = $url_array['app'];
		}

		if(isset($url_array['controller'])){//存在请求controller
			$controller = $model = $url_array['controller'];
			if($app){
				$controller_file = CONTROLLER_PATH.'/'.$app.'/'.$controller.'Controller.php';
				$model_file = MODEL_PATH.'/'.$app.'/'.$model.'Model.php';
			}else{
				$controller_file = CONTROLLER_PATH.'/'.$controller.'Controller.php';
				$model_file = MODEL_PATH.'/'.$model.'Model.php';
			}
		}else{//默认处理controller
			$controller = $model = self::$_config['route']['default_controller'];
			if($app){
				$controller_file = CONTROLLER_PATH.'/'.$app.'/'.self::$_config['route']['default_controller'].'Controller.php';
				$model_file = MODEL_PATH.'/'.$app.'/'.self::$_config['route']['default_controller'].'Model.php';
			}else{
				$controller_file = CONTROLLER_PATH.'/'.self::$_config['route']['default_controller'].'Controller.php';
				$model_file = MODEL_PATH.'/'.self::$_config['route']['default_controller'].'Model.php';
			}
		}
		if(isset($url_array['action'])){
			$action = $url_array['action'];
		}else{
			$action = self::$_config['route']['default_action'];
		}

		if(isset($url_array['params'])){
			$params = $url_array['params'];
		}
		if(file_exists($controller_file)){
			if (file_exists($model_file)) {
				require $model_file;
			}
			require $controller_file;
			$controller = $controller.'Controller';
			$controller = new $controller;
			if($action){
				if(method_exists($controller, $action)){
					isset($params) ? $controller ->$action($params) : $controller ->$action();
				}else{
					die('控制器方法不存在');
				}
			}else{
				die('控制器方法不存在');
			}
		}else{
			die('控制器不存在');
		}
	}



}