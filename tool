#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
require_once __DIR__ . '/app/provider/async/Schedule.php';
require_once __DIR__ . '/app/provider/async/SysCall.php';
require_once __DIR__ . '/app/provider/async/Task.php';
require_once __DIR__ . '/app/provider/async/CoroutineReturnValue.php';

use Symfony\Component\Console\Application;

date_default_timezone_set('Asia/Shanghai');


$options = include __DIR__.'/config/database.php';
foreach ($options as $name => $option) {
    \ORM::configure($option, null, $name);
}


$s = new Schedule();
$s->start((new AsyncMiddleware())->async(new Application()));