<?php

namespace app\lib;

class Mysql
{
    private static $handle;
    private $pdo;
    private $option = [
        'mysql'    => 'mysql',
        'host'     => '127.0.0.1',
        'port'     => 3306,
        'user'     => 'root',
        'password' => '',
        'timeout'  => 5,
    ];
    CONST SQL_TYPE = ['select', 'insert', 'update', 'delete', 'else'];

    private function __construct(array $config = [])
    {
        empty($config) && $config = Config::get('db');
        $this->option = array_merge($this->option, $config);
        try {
            $dsn = $this->option['mysql'] . ":host={$this->option['host']};dbname={$this->option['dbname']}";
            $this->pdo = new \PDO($dsn, $this->option['user'], $this->option['password'],
                [\PDO::ATTR_PERSISTENT => true]);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->query("set names utf8"); //数据库utf8
        } catch (\PDOException $e) {
            dd($e->getMessage());
        }
        return $this;
    }

    public static function instance()
    {
        if (empty(self::$handle)) {
            self::$handle = new self;
        }
        return self::$handle;
    }

    /**
     * 执行查询操作
     * @param string $sql
     * @param array  $param
     * @param int    $line
     * @param int    $column
     */
    public function query($sql, array $param = [], $line = null, $column = null)
    {
        $type = strtolower(strstr($sql, ' ', true));
        if (!in_array($type, self::SQL_TYPE)) {
            throw new \Exception("sql type error");
        }


        $this->filter($param);

        try {
            $obj = $this->pdo->prepare($sql);
            $obj->execute($param);
        } catch (\PDOException $e) {
            throw $e;
        }
        switch ($type) {
            case 'select':
                $result = $obj->fetchAll(\PDO::FETCH_ASSOC);
                if ($line !== null) {
                    $result = $result[$line];
                }
                if ($column !== null) {
                    $result = $result[$column];
                }
                break;
            case 'insert':
                $result = $this->pdo->lastInsertId();
                break;
            case 'update':
            case 'delete':
                $result = $obj->rowCount();
        }
        return $result;
    }

    /**
     * 参数过滤
     * @param array $param
     */
    public function filter(&$param)
    {
        foreach ($param as &$v) {
            $v = trim($v);
            //$v = addslashes($v);
            //$v = htmlspecialchars($v);
        }
    }

    // 关闭连接
    public function __destruct()
    {
        self::$handle = null;
    }
}