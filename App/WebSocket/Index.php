<?php

namespace App\WebSocket;

use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Swoole\Task\TaskManager;
use EasySwoole\Socket\AbstractInterface\Controller;

/**
 * Class Index.
 *
 * 此类是默认的 websocket 消息解析后访问的 控制器
 */
class Index extends Controller
{
    public function hello()
    {
        // $request = $this->request();
        // $data = $request->getRequestParam('content');
        $this->response()->setMessage('aaa');
    }

    public function who()
    {
        /** @var \swoole_websocket_server $server */
        $server = ServerManager::getInstance()->getSwooleServer();
        $start = 0;

        // 此处直接遍历所有FD进行消息投递
        // 生产环境请自行使用Redis记录当前在线的WebSocket客户端FD
        while (true) {
            $conn_list = $server->connection_list($start, 10);
            if (empty($conn_list)) {
                break;
            }
            $start = end($conn_list);
            foreach ($conn_list as $fd) {
                $info = $server->getClientInfo($fd);
                /* 判断此fd 是否是一个有效的 websocket 连接 */
                if ($info && $info['websocket_status'] == WEBSOCKET_STATUS_FRAME) {
                    $server->push($fd, 'http broadcast fd '.$fd.' at '.date('H:i:s'));
                }
            }
        }
    }

    public function delay()
    {
        $this->response()->setMessage('this is delay action');
        $client = $this->caller()->getClient();

        // 异步推送, 这里直接 use fd也是可以的
        TaskManager::async(function () use ($client) {
            $server = ServerManager::getInstance()->getSwooleServer();
            $i = 0;
            while ($i < 5) {
                sleep(1);
                $server->push($client->getFd(), 'push in http at '.date('H:i:s'));
                ++$i;
            }
        });
    }

    public function broadcast()
    {
        /** @var \swoole_websocket_server $server */
        $server = ServerManager::getInstance()->getSwooleServer();
        $start = 0;
        // 此处直接遍历所有FD进行消息投递
        // 生产环境请自行使用Redis记录当前在线的WebSocket客户端FD
        while (true) {
            $conn_list = $server->connection_list($start, 10);
            if (empty($conn_list)) {
                break;
            }
            $start = end($conn_list);
            foreach ($conn_list as $fd) {
                $info = $server->getClientInfo($fd);
                /* 判断此fd 是否是一个有效的 websocket 连接 */
                if ($info && $info['websocket_status'] == WEBSOCKET_STATUS_FRAME) {
                    $server->push($fd, 'http broadcast fd '.$fd.' at '.date('H:i:s'));
                }
            }
        }
    }
}
