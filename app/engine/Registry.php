<?php
namespace bilibili\raichu\engine;
/**
 * 注册表(譬如:DI-Container).
 * User: gukai@bilibili.com
 * Date: 17/2/19
 * Time: 下午2:57
 */
class Registry implements \ArrayAccess
{
    protected static $_instance;
    protected $_data;

    public static function getInstance()
    {
        if (static::$_instance == null) {
            static::$_instance = new static;
        }

        return static::$_instance;
    }

    public function offsetExists($key)
    {
        return array_key_exists($key, $this->_data);
    }

    public function offsetGet($key)
    {
        $data = $this->_data;

        return isset($data[$key]) ? $data[$key] : null;
    }

    public function offsetSet($key, $value = null)
    {
        if (!$key) {
            return false;
        }
        $this->_data[$key] = $value;
    }

    public function offsetUnset($key)
    {
        unset($this->_data[$key]);
    }

    public function __get($key)
    {
        return $this->offsetGet($key);
    }

    public function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    public function __unset($key)
    {
        $this->offsetUnset($key);
    }

    public function __isset($key)
    {
        return $this->offsetExists($key);
    }
}
