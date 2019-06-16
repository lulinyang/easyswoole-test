<?php

namespace App\HttpController;

use App\Model\User;
use App\Utility\Pool\MysqlObject;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Spl\SplBean;
use App\Model\ConditionBean;
use EasySwoole\Http\Message\Status;
use EasySwoole\Utility\Hash;
use EasySwoole\Component\Pool\Exception\PoolEmpty;

class Index extends Base
{
    public function index()
    {
        try {
            $data = MysqlPool::invoke(function (MysqlObject $db) {
                $user = new User($db);
                //new 一个条件类,方便传入条件
                $conditionBean = new ConditionBean();
                $conditionBean->addWhere('name', '', '<>');
                // $conditionBean->setPagination($pageNo, $limit);
                return $user->paginate($conditionBean->toArray([], SplBean::FILTER_NOT_NULL));
            });
            $this->writeJson(200, $data, 'success');
        } catch (\Throwable $throwable) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        } catch (PoolEmpty $poolEmpty) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        }
    }

    public function find()
    {
        try {
            $data = MysqlPool::invoke(function (MysqlObject $db) {
                $user = new User($db);
                //new 一个条件类,方便传入条件
                $conditionBean = new ConditionBean();
                $conditionBean->addWhere('id', '1', '=');

                return $user->find($conditionBean->toArray([], SplBean::FILTER_NOT_NULL));
            });
            $this->writeJson(200, $data, 'success');
        } catch (\Throwable $throwable) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        } catch (PoolEmpty $poolEmpty) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        }
    }

    public function add()
    {
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

    public function update()
    {
        try {
            $data = MysqlPool::invoke(function (MysqlObject $db) {
                $user = new User($db);
                $conditionBean = new ConditionBean();
                $conditionBean->addWhere('id', '1', '=');
                $arr = [
                    'email' => '15655569098@163.com',
                    'password' => Hash::makePasswordHash('123456'),
                ];

                return $user->update($conditionBean, $arr);
            });
            $this->writeJson(200, $data, 'success');
        } catch (\Throwable $throwable) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        } catch (PoolEmpty $poolEmpty) {
            $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        }
    }

    // public function actionNotFound()
    // {
    //     $this->response()->write('404');
    // }
}
