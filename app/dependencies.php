<?php

// 依赖注入
$container = $app->getContainer();


$container['curl'] = function () {
    return new \GuzzleHttp\Client([
        'timeout' => 10,
    ]);
};
// 微信
$container['wechat'] = function () {
    return EasyWeChat\Factory::officialAccount(\app\lib\Config::get('wechat'));
};