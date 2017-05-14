<?php
namespace Raichu\Engine;
/**
 * 装载器,支持自动/手动.
 * User: gukai@bilibili.com
 * Date: 17/2/8
 * Time: 下午6:57
 */
class Loader
{
    /**
     * 返回已经加载的文件
     * @var array
     */
    protected static $loaded = [];


    /**
     * Loader constructor.
     * @param null $module
     */
    public function __construct()
    {
        \spl_autoload_register([$this, 'autoload']);
    }


    /**
     * 返回已经加载的文件
     *
     * @param null $name
     * @return array
     */
    public static function loaded($name = null)
    {
        if (isset(static::$loaded[$name])) {
            return static::$loaded[$name];
        }

        return static::$loaded;
    }


    /**
     * 载入指定模块的文件
     *
     * @param $fileName
     * @param $blockName
     * @param string $suffix
     * @return bool
     */
    public static function import($file, $path = '')
    {
        if (isset(static::$loaded[$file])) {
            return true;
        }

        $fileName = ucfirst(trim($file, 'php')).'.php';
        if ($path) {
            include trim($path, DS) .DS. $file;
        } else {
            $result = [];
            static::traversing(APP_PATH, $result);
            foreach ($result AS $val) {
                if (basename($val) == $fileName) {
                    include_once $val;
                    break;
                }
            }
        }

        return static::$loaded[$file] = 1;
    }


    protected static function traversing($path, &$result)
    {
        $curr = glob($path . '/*');
        if ($curr) {
            foreach ($curr as $f) {
                if (is_dir($f)) {
                    array_push($result, $f);
                    self::traversing($f, $result);
                } elseif (strtolower(substr($f, -4)) == '.php') {
                    array_push($result, $f);
                }
            }
        }
    }


    /**
     * 载入指定文件函数
     *
     * @param $class
     * @return array|bool
     * @throws \Exception
     */
    public function autoload($class)
    {
        if (in_array($class, spl_classes())) {
            return false;
        }

        if ('Model' === substr($class, -5)) {
            $this->model($class);
        } elseif ('Provider' === substr($class, -8)) {
            $this->provider($class);
        } elseif ('Controller' === substr($class, -10)) {
            $this->controller($class);
        } elseif ('Command' === substr($class, -7)) {
            $this->command($class);
        } elseif ("Middleware" === substr($class, -10)) {
            $this->middleware($class);
        } else {
            throw new \Exception("The {$class} Not Found.");
        }

        return static::$loaded;
    }

    /**
     * 递归载入模型文件函数
     *
     * @param $name
     * @return bool|void
     */
    public function model($name)
    {
        if (is_array($name)) {
            foreach ($name AS $val) {
                $this->model($val);
            }
            return;
        }

        if ($name == '' ||
            isset(static::$loaded[$name])) {
            return;
        }

        return static::import($name);
    }


    /**
     * 递归载入库文件函数
     *
     * @param $name
     * @return bool|void
     */
    public function provider($name)
    {
        if (is_array($name)) {
            foreach ($name AS $val) {
                $this->provider($val);
            }
            return;
        }

        if ($name == '' ||
            isset(static::$loaded[$name])) {
            return;
        }

        return static::import($name);
    }

    /**
     * 递归载入控制器文件函数
     *
     * @param $name
     * @return bool|void
     */
    public function controller($name)
    {
        if (is_array($name)) {
            foreach ($name AS $val) {
                $this->controller($val);
            }
            return;
        }

        if ($name == '' ||
            isset(static::$loaded[$name])) {
            return;
        }

        return static::import($name);
    }


    /**
     * 递归载入命令行文件函数
     *
     * @param $name
     * @return bool|void
     */
    public function command($name)
    {
        if (is_array($name)) {
            foreach ($name AS $val) {
                $this->command($val);
            }
            return;
        }

        if ($name == '' ||
            isset(static::$loaded[$name])) {
            return;
        }

        return static::import($name);
    }


    /**
     * 递归载入中间件文件函数
     *
     * @param $name
     * @return bool|void
     */
    public function middleware($name)
    {
        if (is_array($name)) {
            foreach ($name AS $val) {
                $this->middleware($val);
            }
            return;
        }

        if ($name == '' ||
            isset(static::$loaded[$name])) {
            return;
        }

        return static::import($name);
    }

}

