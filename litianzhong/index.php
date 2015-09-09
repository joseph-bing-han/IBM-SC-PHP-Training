<?php
/**
 * 全局控制器
 * 
 */
require dirname(__FILE__).'/framework/app.php';
require dirname(__FILE__).'/config/config.php';
Application::run($CONFIG);