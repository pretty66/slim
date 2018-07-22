<?php

namespace app\lib;

class Config
{
    private static $handle;
    protected $file_name = APP_PATH . 'config.php';
    private $config = [];

    private function __construct($file = null)
    {
        empty($file) || $this->file_name = $file;
        if (!file_exists($this->file_name)) {
            throw new \Exception("config file not exist!");
        }
        $this->config = include $this->file_name;
    }

    public static function instance($file = null)
    {
        if (empty(self::$handle)) {
            self::$handle = new self($file);
        }
        return self::$handle;
    }

    public static function init($file = null)
    {
        self::instance($file);
    }

    public static function get($key = null)
    {
        if (empty($key)) {
            return self::instance()->config;
        }
        $key_arr = explode('.', $key);
        $value = self::instance()->config;
        foreach ($key_arr as $v) {
            if (isset($value[$v])) {
                $value = $value[$v];
            } else {
                return null;
            }
        }
        return $value;
    }

    public static function set($key, $value)
    {
        $key_arr = explode('.', $key);
        switch (count($key_arr)) {
            case 1:
                self::instance()->config[$key_arr[0]] = $value;
                break;
            case 2:
                self::instance()->config[$key_arr[0]][$key_arr[1]] = $value;
                break;
            case 3:
                self::instance()->config[$key_arr[0]][$key_arr[1]][$key_arr[2]] = $value;
                break;
            default:
                throw new \Exception("配置标识不易过长！");
        }
    }
}