<?php

namespace app\lib;


class Cache
{
    private static $handle;
    private static $self;

    private $option = [
        'host'     => '127.0.0.1',
        'port'     => 6379,
        'password' => '',
        'db'       => 0,
        'timeout'  => 5,
    ];

    private function __construct()
    {
        $conf = Config::get('redis');

        empty($conf) || $this->option = array_merge($this->option, $conf);

        $conn = new \Redis();
        $is = $conn->connect($this->option['host'], $this->option['port'], $this->option['timeout']);
        if (false === $is) {
            throw new \Exception('redis connect failed');
        }
        !empty($this->option['password']) && $conn->auth($this->option['password']);
        !empty($this->option['db']) && $conn->select($this->option['db']);
        self::$handle = $conn;
    }

    public static function instance()
    {
        if (empty(self::$self)) {
            $self = new self;
        }
        return $self;
    }

    /**
     * 获取redis连接
     * @return \Redis
     */
    public function handle()
    {
        return self::$handle;
    }

    /**
     * @param \Redis $handle
     */
    public static function __callStatic($method, $args)
    {
        return self::instance()->handle()->$method(...$args);
    }
}

