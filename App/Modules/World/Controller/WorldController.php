<?php
use Raichu\Engine\AbstractController;
use Raichu\Engine\Loader;
/**
 * 世界你好.
 * User: gukai@bilibili.com
 * Date: 17/3/2
 * Time: 下午7:53
 */
class WorldController extends AbstractController
{

    protected $load;


    public function __construct()
    {
        parent::initialize();
        $this->load = new Loader();
        $this->load->model('Hello', "Hello");
        $this->load->provider('Hello', "Hello");
        $this->load->controller('Hello', "Hello");
    }


    public function afterExecuteRoute($dispatcher)
    {
        echo var_dump('foo') . PHP_EOL;
    }


    public function beforeExecuteRoute($dispatcher)
    {
        echo var_dump('bar') . PHP_EOL;
    }


    public function hello($request)
    {
        // $m = new HelloModel();
        // echo $m->shakehands();

        // $p = new HelloProvider();
        // echo $p->music();

        $c = new HelloController();
        echo $c->index($request);
    }


    public function shakehands()
    {
        echo (new WorldProvider())->lets();
        exit;
    }

}