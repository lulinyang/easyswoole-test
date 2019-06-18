<?php

namespace App\HttpController;

use App\Model\User;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Spl\SplBean;
use App\Model\ConditionBean;
use EasySwoole\Http\Message\Status;
use EasySwoole\Utility\Hash;
use EasySwoole\Component\Pool\Exception\PoolEmpty;

class UserController extends Base
{
    public function index()
    {
    }

    //注册
    public function register()
    {
        $params = $this->Request()->getRequestParam();
        //new 一个条件类,方便传入条件
        $conditionBean = new ConditionBean();
        $this->conditionBean->addWhere('name', $params['name'], '=');
        try {
            $db = MysqlPool::defer();
            $user = new User($db);
            $res = $user->find($conditionBean->toArray([], SplBean::FILTER_NOT_NULL));
            if ($res) {
                $this->writeJson(1001, false, '用户名重复');
            } else {
                $arr = [
                    'name' => $params['name'],
                    'password' => Hash::makePasswordHash($params['password']),
                    'created_at' => date('Y-m-d H:i:s', time()),
                ];
                $data = $user->insert($arr);
                $this->writeJson(200, $data, 'success');
            }
        } catch (\Throwable $throwable) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        } catch (PoolEmpty $poolEmpty) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        }
    }

    //登录
    public function login()
    {
        $params = $this->Request()->getRequestParam();
        $conditionBean = new ConditionBean();
        $conditionBean->addWhere('name', $params['name'], '=');
        $db = MysqlPool::defer();
        $user = new User($db);
        $res = $user->find($conditionBean->toArray([], SplBean::FILTER_NOT_NULL));
        if ($res) {
            $hash = Hash::makePasswordHash($res->password);
            $res = Hash::validatePasswordHash($params['password'], $hash);
            if (!$res) {
                $this->writeJson(200, '密码不正确！', 'success');
            } else {
                $this->writeJson(200, $res, 'success');
            }
        } else {
            $this->writeJson(200, '用户名不存在！', 'success');
        }
    }
}
