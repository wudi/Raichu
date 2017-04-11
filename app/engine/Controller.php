<?php
namespace bilibili\raichu\engine;
use bilibili\raichu\engine\Loader;
/**
 * 逻辑控制及Model/View交互
 * User: gukai@bilibili.com
 * Date: 17/2/15
 * Time: 下午6:57
 */
class Controller
{
    protected $middleware;

    public function __construct()
    {
        if ($this->middleware) {
            $middleware = $this->middleware;
            if (is_array($middleware)) {
                $middleware[0] = $middleware[0];
                $middleware[0] = new $middleware[0]();
            }
            call_user_func($middleware);
        }
    }

    public function middleware($middleware)
    {
        if (is_string($middleware) && strstr($middleware, '@')) {
            $middleware = explode('@', $middleware);
        }
        $this->middleware = $middleware;
    }

    public function getView()
    {
        return View::getInstance();
    }

    public function getResponse()
    {
        return Response::getInstance();
    }

    public function autoload($modules = null)
    {
        return Loader::getInstance($modules);
    }

}
