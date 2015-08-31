<?php
abstract class AbstractDB{

	/**
	 *
	 * @returns object data object;
	 * @access public
	 */
	abstract public static function getInstance();

    /**
     * 执行SQL语句
     * @param string $query sql 语句
     * @return object resource or false;
     * @access public
     */
    abstract public function execute($query);
    /**
     * 获取SQL语句返回的数组
     * @param string $query sql 语句
     * @return object resource or false;
     * @access public
     */
    abstract public function Query($query);
    /**
     * 获取上一条语句的执行ID
     * @param string $query sql 语句
     * @return integer number or false;
     * @access public
     */
    abstract public function insert_get_id($query);
    /**
     * 转化特殊字符
     * @param string $string
     * @return string 处理后的字符串
     * @access public
     */
    abstract public function clean($string);
}
?>
