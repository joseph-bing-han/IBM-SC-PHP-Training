<?php
/**
 * 基础controller
 * @author      李天中
 * @version     1.0
 */
class Controller{
	private $smarty = '';
	public static $LogUtil;
	/***
	*重写构造方法
	*初始化smarty
	*/
	public function __construct() {
		 self::$LogUtil=Application::$_lib['LogUtil'];
		 require_once(SYS_LIB_PATH.'/smarty/Smarty.class.php');
		 $this->smarty = new Smarty;
		 $this->smarty->force_compile = true;
		 $this->smarty->debugging = false;
		 $this->smarty->caching = false;
		 $this->smarty->cache_lifetime = 120;
		 
		 $this->smarty->left_delimiter = '{{';
		 $this->smarty->right_delimiter = '}}';
		 
		 $this->smarty->setTemplateDir(VIEW_PATH);
		 $this->smarty->setCompileDir(SYS_LIB_PATH.'/smarty/templates_c/');
		 $this->smarty->setConfigDir(SYS_LIB_PATH.'/smarty/configs/');
		 $this->smarty->setCacheDir(SYS_LIB_PATH.'/smarty/cache/');
		 
		 $this->smarty->assign('BASE_URL',BASE_URL);
		 $this->smarty->assign('STATIC_URL',STATIC_URL);
	}
	/**
	 * 实例化模型
	 * @access      final   protected
	 * @param       string  $model  模型名称
	 */
	final protected function model($model) {
		if (empty($model)) {
			trigger_error('不能实例化空模型');
		}
		$model_name = $model . 'Model';
		return new $model_name;
	}
	
	/**
	 *获得配置文档
	 * @access      final   protected
	 */
	final   protected function config($config){
		return Application::$_config[$config];
	}
	/***
	 * 展示模板
	 * @param  $path
	 */
	public function display($path){
		$this->smarty->display($path);
	}
	
	/***
	 * 设置值
	 * @param  $key
	 * @param  $val
	 */
	public function assign($key,$val){
		$this->smarty->assign($key, $val);
	}
}
