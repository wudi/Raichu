<?php
use bilibili\raichu\engine\AbstractController;
use bilibili\raichu\engine\Transport;
/**
 * 你好世界.
 * User: gukai@bilibili.com
 * Date: 17/2/7
 * Time: 下午6:19
 */
class HelloController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();
    }


    /*
    public function beforeExecuteRoute($dispatcher = null)
    {
        return var_dump('foo') . PHP_EOL;
    }


    public function afterExecuteRoute($dispatcher = null)
    {
        return var_dump('bar') . PHP_EOL;
    }
    */


    public function index($request)
    {
        echo $this->hello() . PHP_EOL;
    }


    public function logger()
    {
        $t = new Transport([
            'basePath' => '/tmp',
            'logger' => 'manager',
            'datetimeFormat' => 'Y:m:d H:i:s',
        ]);
        $t->use_local('error', 'im shies');
    }


    public function shakehands($request)
    {
        echo $request->get('id') ?: 0;
        echo $this->hello(),$this->listen($request);
    }


    private function hello()
    {
        echo (new HelloModel())->shakehands();
    }


    public function listen($request)
    {
        echo (new HelloProvider())->music();
    }

}