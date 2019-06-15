<?php

namespace App\HttpController;

use App\Model\User;
use App\Utility\Pool\MysqlObject;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Spl\SplBean;
use App\Model\ConditionBean;

class Index extends Base
{
    public function index()
    {
        // $this->writeJson(200, 'aaa', 'success');
        // try {
        $data = MysqlPool::invoke(function (MysqlObject $db) {
            $user = new User($db);
            //new 一个条件类,方便传入条件
            $conditionBean = new ConditionBean();
            $conditionBean->addWhere('name', '', '<>');
            $this->writeJson(200, $conditionBean->toArray([], SplBean::FILTER_NOT_NULL), 'success');

            return $user->getAll($conditionBean->toArray([], SplBean::FILTER_NOT_NULL));
        });
        $this->writeJson(200, $data, 'success');
        // } catch (\Throwable $throwable) {
        //     $this->writeJson(Status::CODE_BAD_REQUEST, null, $throwable->getMessage());
        // } catch (PoolEmpty $poolEmpty) {
        //     $this->writeJson(Status::CODE_BAD_REQUEST, null, '没有链接可用');
        // } catch (PoolUnRegister $poolUnRegister) {
        //     $this->writeJson(Status::CODE_BAD_REQUEST, null, '连接池未注册');
        // }
    }

    public function test()
    {
        $this->response()->write('去你大爷的');
    }

    // public function actionNotFound()
    // {
    //     $this->response()->write('404');
    // }
}
