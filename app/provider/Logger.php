<?php
namespace bilibili\raichu\Provider\logger;
/**
 * 本地日志收集器.
 * User: gukai@bilibili.com
 * Date: 16/11/22
 * Time: 下午8:16.
 */
class Logger
{
    protected static $_instance;

    public static function getInstance()
    {
        if (static::$_instance === null) {
            static::$_instance = new static();
        }

        return static::$_instance;
    }

    public function setConfig($config)
    {
        !isset($config['basePath']) || \SeasLog::setBasePath($config['basePath']);
        !isset($config['logger']) || \SeasLog::setLogger($config['logger']);
        !isset($config['datetimeFormat']) || \SeasLog::setDatetimeFormat($config['datetimeFormat']);
    }

    public function error($message)
    {
        \SeasLog::error($message);
    }

    public function info($message)
    {
        \SeasLog::info($message);
    }

    public function notice($message)
    {
        \SeasLog::notice($message);
    }

    public function warning($message)
    {
        \SeasLog::warning($message);
    }

    public function log($level, $message)
    {
        \SeasLog::log($level, $message);
    }

    public function analyzerDetail($level, $datetime = '')
    {
        return \SeasLog::analyzerDetail($level, $datetime);
    }

    public function analyzerCount($level, $datetime = '')
    {
        return \SeasLog::analyzerCount($level, $datetime);
    }
}
