<?php

namespace App\HttpController;

use App\Model\User;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Http\Message\Status;
use EasySwoole\Utility\Hash;
use EasySwoole\Component\Pool\Exception\PoolEmpty;

class Users extends Base
{
    public function index()
    {
    }

    public function register()
    {
        $params = $this->Request()->getRequestParam();
        try {
            $db = MysqlPool::defer();
            $user = new User($db);
            $arr = [
                'name' => $params['name'],
                'password' => Hash::makePasswordHash($params['password']),
            ];

            $data = $user->insert($arr);

            $this->writeJson(200, $data, 'success');
        } catch (\Throwable $throwable) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        } catch (PoolEmpty $poolEmpty) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        }
    }
}
