<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-01-01
 * Time: 20:06.
 */

return [
    'SERVER_NAME' => 'EasySwoole',
    'MAIN_SERVER' => [
        'LISTEN_ADDRESS' => '0.0.0.0',
        'PORT' => 9501,
        'SERVER_TYPE' => EASYSWOOLE_WEB_SOCKET_SERVER, //可选为 EASYSWOOLE_SERVER  EASYSWOOLE_WEB_SERVER EASYSWOOLE_WEB_SOCKET_SERVER,EASYSWOOLE_REDIS_SERVER
        'SOCK_TYPE' => SWOOLE_TCP,
        'RUN_MODEL' => SWOOLE_PROCESS,
        'SETTING' => [
            'worker_num' => 8,
            'task_worker_num' => 8,
            'reload_async' => true,
            'task_enable_coroutine' => true,
            'max_wait_time' => 3,
        ],
    ],
    'TEMP_DIR' => null,
    'LOG_DIR' => null,
    'PHAR' => [
        'EXCLUDE' => ['.idea', 'Log', 'Temp', 'easyswoole', 'easyswoole.install'],
    ],
    'CONSOLE' => [//console组件配置,完整配置可查看:http://easyswoole.com/Manual/3.x/Cn/_book/SystemComponent/Console/Introduction.html
        'ENABLE' => true, //是否开启console
        'LISTEN_ADDRESS' => '192.168.204.129', //console服务端监听地址
        'HOST' => '192.168.204.129', //console客户端连接远程地址
        'PORT' => 9500, //console服务端监听端口,客户端连接远程端口
        'EXPIRE' => '120', //心跳超时时间
        // 'AUTH'           => null,//鉴权密码,如不需要鉴权可设置null
        'AUTH' => [
            [
                'USER' => 'root',
                'PASSWORD' => 'root',
                'MODULES' => [
                    'auth', 'server', 'help', 'test',
                ],
                'PUSH_LOG' => true,
            ],
        ],
    ],
];
