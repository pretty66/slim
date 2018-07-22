<?php

namespace app\controller;

use Psr\Container\ContainerInterface;

/**
 * Class Common
 * @package app\controller
 * @property \app\lib\Cache cache
 * @property \Illuminate\Database\Capsule\Manager db
 * @property \GuzzleHttp\Client curl
 */
class Common
{
    protected $container;
    protected $cache;
    protected $curl;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->curl = $container->get('curl');
    }
}