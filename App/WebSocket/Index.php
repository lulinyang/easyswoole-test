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
        $this->response()->setMessage('call aaaahello with arg:'.json_encode($this->caller()->getArgs()));
    }

    public function who()
    {
        $this->response()->setMessage('your fd is '.$this->caller()->getClient()->getFd());
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
}
