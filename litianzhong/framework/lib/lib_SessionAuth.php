<?php
/**
 * @Auth: 李天中
 * Class SessionAuth
 * @package Cross\Auth
 */
class SessionAuth
{
    /**
     *
     * @var string
     */
    protected $key;

    function __construct($key = '')
    {
        if ($key) {
            $this->key = $key;
        }

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * 设置session的值
     *
     * @param $key
     * @param $value
     * @param int $exp
     * @return bool|mixed
     */
    function set($key, $value, $exp = 86400)
    {
        $_SESSION[$key] = $value;

        return true;
    }

    /**
     * 获取session的值
     *
     * @param $key
     * @param bool $de
     * @return mixed
     */
    function get($key, $de = false)
    {
        if (false !== strpos($key, ':')) {
            list($v_key, $c_key) = explode(':', $key);
        } else {
            $v_key = $key;
        }

        $_result = $_SESSION[$v_key];
        if (!empty($c_key) && isset($_result[$c_key])) {
            return $_result[$c_key];
        }

        return $_result;
    }
}