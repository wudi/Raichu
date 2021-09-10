<?php
namespace Raichu\Engine;
use Raichu\Engine\App;
/**
 * 分发器.
 * User: Shies
 * Date: 2017/3/5
 * Time: 下午5:37
 */
class Dispatcher
{

    /**
     * 获取路由对象
     * @var object
     */
    protected $router;

    /**
     * 获取视图对象
     * @var object
     */
    protected $view;

    /**
     * 获取APP对象
     * @var object
     */
    protected $app;

    /**
     * 立刻的刷新
     * @var boolean
     */
    protected $instantly_flush;

    /**
     * 根据url获取指定的控制器
     * @var string
     */
    protected $controller;

    /**
     * 根据url获取指定的方法
     * @var string
     */
    protected $method;

    /**
     * 根据url获取指定的参数
     * @var array
     */
    protected $args = [];



    /**
     * Dispatcher constructor.
     * @param \Raichu\Engine\App $app
     */
    public function __construct()
    {
        $this->app = App::getInstance();
        $this->router = $this->app->getRouter();
        $this->view = $this->app->getView();
    }


    /**
     * 渲染指定的模版函数
     *
     * @param $name
     * @param array $data
     * @param bool|false $display
     * @return bool|null
     */
    public function render($name, $data = [], $display = true)
    {
        if (defined('TPL_PATH')) {
            $this->view->setPath(TPL_PATH);
        }

        $buffer = NULL;
        if ($display === true) {
            $this->view->render($name, $data, $display);
        } else {
            $buffer = $this->view->render($name, $data, $display);
        }

        if ($this->instantly_flush) {
            flush();
            ob_flush();
        }

        return $buffer;
    }


    /**
     * 调度器解析RouterURL
     * @return void
     */
    public function parseRouterUrl(Request $request)
    {
        $this->router->parseUrl($request);
    }


    /**
     * 通过调度器执行Request/Callback
     *
     * @param callable $request
     * @return bool
     */
    public function dispatch(Request $request, $uri = null)
    {
        $req = $uri ? $request->setUri($uri) : $request;
        $this->parseRouterUrl($req);
        $this->router->run($req);
        return true;
    }


    /**
     * 设置对象的参数
     * @param array $params
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * 301/302重定向
     * @param string $url
     */
    public function redirect($uri, $method = 'location', $http_response_code = 302)
    {
        switch ($method) {
            case 'refresh':
                header("Refresh:0;url=".$uri);
                break;
            default:
                header("Location: ".$uri, true, $http_response_code);
                break;
        }
        exit;
    }


    /**
     * 通过调度器设置中间件
     *
     * @param $cls
     * @param $middleware
     */
    public function getMiddleware($name)
    {
        if (!is_string($name)) {
            return false;
        }

        $instance = null;
        if (method_exists($name, "getInstance")) {
            $instance = $name::getInstance($this->app);
        }

        return $instance;
    }


    /**
     * controller => Hello::class,
     * action => index,
     * params => [one, two, three]
     * 控制器之间互相回调
     *
     * @return array
     */
    public function forward(array $url)
    {
        $this->parseSegment($url);

        // create controller instance and call the specified method
        $cont = (new $this->controller);

        try {
            $ref = new \ReflectionMethod($this->controller, $this->method);
            $args = $ref->getParameters();

            $first = array_shift($args);
            if (isset($first->name)) {
                if ($first->name == "request") {
                    $first = $this->app->getRequest();
                }
            }

            // 如果第一个参数不是request,证明是普通参数
            $args = $this->args;
            if (!$first instanceof Request) {
                $first = array_shift($args);
            }

            if ($first) {
                if (0 == count($args)) {
                    $ref->invokeArgs($cont, [$first]);
                } elseif (1 == count($args)) {
                    $ref->invokeArgs($cont, [$first, $args[0]]);
                } elseif (2 == count($args)) {
                    $ref->invokeArgs($cont, [$first, $args[0], $args[1]]);
                }
            } else {
                $ref->invokeArgs($cont, []);
            }
        } catch(\Exception $e) {
            return false;
        }
    }


    /**
     * 获取URL参数
     * @param array $url
     */
    private function parseSegment(array $url)
    {
        $this->args = isset($url['params']) ? $url['params'] : null;
        $this->method = isset($url['action']) ? $url['action'] : 'index';
        $this->controller = isset($url['controller'])
            ? $url['controller']
            : get_class(AbstractController::getInstance());
    }


}