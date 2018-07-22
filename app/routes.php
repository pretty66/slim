<?php

use Slim\Http\Request;
use Slim\Http\Response;

/*$app->get('/home', function () {

});*/

// 微信相关
$app->group('/wechat', function () {

});
// 后台管理
$app->group('/admin', function () {


});

// test
$app->any('/home', 'app\\controller\\Home:index');
