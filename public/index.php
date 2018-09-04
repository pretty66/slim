<?php


use app\lib\Config;

require __DIR__ . '/../vendor/autoload.php';

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', __DIR__ . DS);
define('APP_PATH', ROOT_PATH . '../app' . DS);

Config::init(APP_PATH . 'config.php');

// 加载配置文件
App(Config::get());

// 加载依赖
file_exists(APP_PATH . 'dependencies.php') && require APP_PATH . 'dependencies.php';
// 注册中间件
file_exists(APP_PATH . 'middleware.php') && require APP_PATH . 'middleware.php';
// 注册路由
file_exists(APP_PATH . 'routes.php') && require APP_PATH . 'routes.php';

try {
    App()->run();
} catch (\Exception $e) {
    dd($e);
}
