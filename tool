#!/usr/bin/env php
<?php

define('ROOT', __DIR__);
require ROOT .'/vendor/autoload.php';
include ROOT .'/Config/defined.php';

use Symfony\Component\Console\Application;
use Raichu\Provider\Async\Task;
use Raichu\Provider\Async\Schedule;
use Raichu\Provider\Async\SysCall;
use Raichu\Provider\Async\CoroutineReturnValue;
date_default_timezone_set('Asia/Shanghai');
new Raichu\Engine\Loader();

/*
$options = include __DIR__.'/config/database.php';
foreach ($options as $name => $option) {
    \ORM::configure($option, null, $name);
}
*/

$s = new Schedule();
$s->start((new AsyncMiddleware())->async(new Application()));