<?php

namespace app\model;


class Common extends \Illuminate\Database\Eloquent\Model
{

    protected $capsule;

    public function __construct()
    {
        $this->connect();
        parent::__construct();
    }

    private function connect()
    {
        if (empty($this->capsule)) {
            $capsule = new \Illuminate\Database\Capsule\Manager;
            $capsule->addConnection(\app\lib\Config::get('db'));

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            $capsule->getConnection();
        }
    }

}