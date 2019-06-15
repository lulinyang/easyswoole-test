<?php
    return [
        'MYSQL' => [
            'host' => '192.168.204.128', //数据库连接ip
            'user' => 'root', //数据库用户名
            'password' => 'root', //数据库密码
            'database' => 'chat', //数据库
            'port' => '3306', //端口
            'timeout' => '30', //超时时间
            'connect_timeout' => '5', //连接超时时间
            'charset' => 'utf8', //字符编码
            'strict_type' => false, //开启严格模式，返回的字段将自动转为数字类型
            'fetch_mode' => false, //开启fetch模式, 可与pdo一样使用fetch/fetchAll逐行或获取全部结果集(4.0版本以上)
            'alias' => '', //子查询别名
            'isSubQuery' => false, //是否为子查询
            'max_reconnect_times ' => '3', //最大重连次数
        ],
    ];
