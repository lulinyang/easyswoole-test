<?php

namespace App\HttpController;

use App\Model\User;
use App\Utility\Pool\MysqlObject;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Http\Message\Status;
use EasySwoole\Utility\Hash;
use EasySwoole\Component\Pool\Exception\PoolEmpty;
use EasySwoole\Http\Request;

class Users extends Base
{
    public function index()
    {
    }

    public function register()
    {
        $request = new Request();
        $params = $request->getRequestParam();
        $this->writeJson(200, $params, 'success');
        $this->response()->end();

        try {
            $data = MysqlPool::invoke(function (MysqlObject $db) {
                $user = new User($db);
                $password = '123456';
                $arr = [
                    'name' => '张三',
                    'email' => '12228380958@qq.com',
                    'password' => Hash::makePasswordHash($password),
                ];

                return $user->insert($arr);
            });
            $this->writeJson(200, $data, 'success');
        } catch (\Throwable $throwable) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        } catch (PoolEmpty $poolEmpty) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        }
    }
}
