<?php

use Slim\Http\Request;
use Slim\Http\Response;

//$app->any('/home', 'app\\controller\\Home:index');
$app = App();

$app->get('/qrcode/get_content', 'app\\controller\\QrCode:getContent');


