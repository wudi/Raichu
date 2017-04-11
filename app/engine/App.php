<?php
namespace bilibili\raichu\engine;
use bilibili\raichu\engine\logger\Logger;
use bilibili\raichu\middleware\clockwork\Monitor;
use bilibili\raichu\middleware\clockwork\CacheStorage;
/**
 * 应用业务逻辑抽象实例
 * User: gukai@bilibili.com
 * Date: 17/2/11
 * Time: 下午4:57
 */
class App
{
    protected static $_instance;

    protected $_data = array();

    public static function getInstance($debug = false)
    {
        if (static::$_instance == null) {
            static::$_instance = new static($debug);
        }

        return static::$_instance;
    }

    public function openDebug()
    {
        $registry = Registry::getInstance();
        $registry->debug = true;
        $storage = null;
        if ($mc_config = $registry->memcache_config) {
            $storage = new CacheStorage($mc_config['host'], $mc_config['port']);
        }
        $clockwork = Monitor::getClockwork($storage);
        Router::getInstance()->get(
            '/__clockwork/(.*)', function ($request, $id) use ($clockwork) {
                header('Content-Type: application/json');
                echo $clockwork->getStorage()->retrieveAsJson($id);
                exit;
            }
        );
        Monitor::getInstance()->startEvent('App Request', 'Total Time Costs.');
    }

    public function setDB(array $config)
    {
        foreach ($config as $name => $option) {
            if (Registry::getInstance()->debug) {
                $option['logging'] = true;
                \ORM::configure(
                    'logger', function ($query, $time) {
                        Model::logging($query, $time);
                    }, $name
                );
            }
            \ORM::configure($option, null, $name);
        }
    }

    public function getRegistry()
    {
        return Registry::getInstance();
    }

    public function getRouter()
    {
        return Router::getInstance();
    }

    public function getLogger()
    {
        // return Logger::getInstance();
    }

    public function getRequest()
    {
        return Request::getInstance();
    }

    public function getResponse()
    {
        return Response::getInstance();
    }

    public function getView()
    {
        return View::getInstance();
    }

    public static function getDB($database = 'default')
    {
        return \ORM::get_db($database);
    }

    public static function getModel($table, $database = 'default')
    {
        return new Model($table, $database);
    }

    public static function middleware($cls, $middleware, $is_static = false)
    {
        $cls = ucfirst($cls);
        if (!$is_static) {
            (new $cls())->middleware($middleware);
        } else {
            $cls::middleware($middleware);
        }
    }

    public function autoload($modules = null)
    {
        return new Loader($modules);
    }


    public function dispatcher()
    {
        return new Dispatcher($this);
    }

}
