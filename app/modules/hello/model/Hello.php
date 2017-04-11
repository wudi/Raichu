<?php
/**
 * 生产者.
 * User: gukai@bilibili.com
 * Date: 17/2/8
 * Time: 下午8:36
 */
use bilibili\raichu\engine\AbstractModel;

class HelloModel extends AbstractModel
{

    protected $_database = 'default';
    protected $_table = 'logger';


    public function __construct()
    {
        parent::initialize();
    }


    public function shakehands()
    {
        return 'hello world' . PHP_EOL;
    }


    public function listen()
    {
        return 'sound of my dreams';
    }

}