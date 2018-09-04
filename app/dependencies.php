<?php

// 依赖注入
$container = App()->getContainer();


$container['curl'] = function () {
    return new \GuzzleHttp\Client([
        'timeout' => 10,
    ]);
};
