<?php
namespace bilibili\raichu\Provider;
use bilibili\raichu\Provider\logger\Logger;
use bilibili\raichu\Provider\logger\Elk;
use bilibili\raichu\Provider\logger\SeasLog;

/**
 * 日志传输类.
 * User: gukai@bilibili.com
 * Date: 17/2/22
 * Time: 下午3:40
 */
class Transport
{

    protected static $instance;
    protected static $config;


    public function getInstance(array $config = null)
    {
        if (empty(static::$instance)) {
            static::$instance = new static($config);
        }

        return static::$instance;
    }


    public function __construct(array $config)
    {
        static::$config = $config;
    }


    public function socket($action, array $logs)
    {
        $elk = new Elk();
        $elk->configure(static::$config);
        if (!method_exists($elk, $action)) {
            throw new Exception('not exists the action');
        }

        return call_user_func([$elk, $action], $logs);
    }


    public function local($action, $logs)
    {
        $logger = SeasLog::getInstance();
        $logger->setConfig(static::$config);
        if (!method_exists($logger, $action)) {
            throw new Exception('not exists the action');
        }

        return call_user_func([$logger, $action], $logs);
    }


    public function __destruct()
    {
        return static::$config;
    }


    public function __clone()
    {
        return static::$instance;
    }


}