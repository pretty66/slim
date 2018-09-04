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
        $count = count($key_arr) - 1;
        $config = &self::instance()->config;
        for ($i = 0; $i < $count; $i++) {
            if (!isset($config[$key_arr[$i]])) {
                $config[$key_arr[$i]] = null;
            }
            $config = &$config[$key_arr[$i]];
        }
        $config[end($key_arr)] = $value;
    }
}