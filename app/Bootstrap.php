<?php

use bilibili\raichu\engine\App;
use bilibili\raichu\engine\Dispatcher;
use bilibili\raichu\Provider\Session;

include ROOT.'/app/config/defined.php';
/*
assert_options(ASSERT_ACTIVE, true);
assert_options(ASSERT_WARNING, true);
assert_options(ASSERT_BAIL, true);
assert_options(ASSERT_CALLBACK, ASSERT_ALERT);
*/

// If has been set in php.ini, then override.
Session::config();

$app = App::getInstance();

// Enable Debug
$app->openDebug();

// Init Database
$options = include __DIR__.'/config/database.php';
$app->setDB($options);

// Init common config
$app->getRegistry()->config = include ROOT.'/app/config/config.php';

// Init Dispacher
$app->dispatcher();

// Init Router
$router = $app->getRouter();

// Init Loader
$app->autoload($router->fetchModules());


try {
    $files = ROOT.'/app/modules/*/route*.*';
    foreach (glob($files) AS $val) {
        require_once $val;
    }

    $router->run();
} catch (Exception $e) {
    $data['code'] = $e->getCode();
    $data['msg'] = $e->getMessage();

    $app->getResponse()->ajaxReturn($data);
}
