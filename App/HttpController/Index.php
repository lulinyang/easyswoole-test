<?php

namespace App\HttpController;

use EasySwoole\EasySwoole\Config;
use EasySwoole\MysqliPool\Mysql;
use App\Model\User;
use App\Utility\Pool\MysqlObject;
use App\Utility\Pool\MysqlPool;
use EasySwoole\Spl\SplBean;
use App\Model\ConditionBean;

class Index extends Base
{
    public function index()
    {
        // $Conf = Config::getInstance()->getConf('DATABASE');
        // $db = Mysql::defer('mysql');
        // $data = $db->get('users');
        // // $this->response()->write('Hello World');
        // $this->writeJson(200, $data, 'success');
        $data = MysqlPool::invoke(function (MysqlObject $db) {
            return $user = new User($db);
            //new 一个条件类,方便传入条件
            $conditionBean = new ConditionBean();
            $conditionBean->addWhere('name', '', '<>');

            return $user->getAll($conditionBean->toArray([], SplBean::FILTER_NOT_NULL));
        });
        $this->writeJson(200, $data, 'success');
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
