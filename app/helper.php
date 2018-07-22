<?php

if (!function_exists('dd')) {
    function dd(...$var)
    {
        var_dump(...$var);
        die;
    }
}
function pp(...$var)
{
    echo '<pre>';
    foreach ($var as $v) {
        print_r($v);
    }
    echo '</pre>';
}

#数据库查询
function M($sql, $param = [], $line = null, $column = null)
{
    return \app\lib\Mysql::instance()->query($sql, $param, $line, $column);
}
