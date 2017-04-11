<?php
use bilibili\raichu\engine\Session;
use bilibili\raichu\engine\App;
use bilibili\raichu\middleware\Middleware;
use Symfony\Component\Console\Application;
/**
 * 异步非阻塞(cli).
 * User: gukai@bilibili.com
 * Date: 17/2/23
 * Time: 下午2:59
 */
class AsyncMiddleware implements Middleware
{
    // use strict
    protected static $instance;
    protected $command;


    public static function getInstance(App $app)
    {
        if (null === static::$instance) {
            static::$instance = new static($app);
        }

        return static::$instance;
    }


    public function async(Application $app)
    {
        $app = (yield $this->retval($app));
        yield $this->parallel($this->updateTask($app, $this), $this->archiveTask($app));
        yield $this->runCommand($app);
    }


    public function updateTask($app, $async)
    {
        // yield $async->parallel($this->foo(), $this->bar());
        yield $app->add(new UpdateCommand());
    }

    public function archiveTask($app)
    {
        yield $app->add(new ArchiveCommand());
    }

    public function foo()
    {
        yield;
        echo 'happy';
        yield var_dump('foo');
    }


    public function bar()
    {
        yield var_dump('bar');
        echo 'bad';
        yield;
    }


    public function runCommand($app)
    {
        yield $app->run();
    }


    private function retval($value)
    {
        yield new CoroutineReturnValue($value);
    }


    private function parallel()
    {
        $args = func_get_args();
        return new SysCall(function(Task $task, Schedule $schedule) use ($args) {
            foreach ($args AS $val) {
                $schedule->start($val);
            }
            return Schedule::TICK_INTERVAL;
        });
    }


    private function __clone()
    {
        return static::$instance;
    }

}
