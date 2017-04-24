<?php
namespace bilibili\raichu\engine;

/**
 * 逻辑控制及Model/View交互
 * User: gukai@bilibili.com
 * Date: 17/2/15
 * Time: 下午6:57
 */
class Controller extends Container
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
        $this->singleton("view", View::class);
        return $this->make("view");
    }


    public function getResponse()
    {
        $this->singleton("response", Response::class);
        return $this->make("response");
    }


    public function make($abstract, array $parameters = [])
    {
        return parent::make($abstract, $parameters);
    }

}
