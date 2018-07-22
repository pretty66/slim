<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        /*'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],*/
        // Monolog settings
        /*'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],*/
    ],
    /*'db' => [
        'mysql'    => 'mysql',
        'host'     => '127.0.0.1',
        'port'     => 3306,
        'user'     => 'root',
        'password' => 'root',
        'timeout'  => 5,
        'dbname'   => 'znm'
    ],*/
    'db' => [
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'database' => 'znm',
        'username' => 'root',
        'password' => 'root',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => 'b_',
    ],
    'redis' => [
        'host'     => '127.0.0.1',
        'port'     => 6399,
        'password' => '',
        'db'       => 0,
        'timeout'  => 7,
    ]
];