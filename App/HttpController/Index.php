<?php

namespace App\HttpController;

use EasySwoole\EasySwoole\Config;
use EasySwoole\MysqliPool\Mysql;

class Index extends Base
{
    public function index()
    {
        $Conf = Config::getInstance()->getConf('DATABASE');
        $db = Mysql::defer('mysql');
        $data = $db->get('users');
        // $this->response()->write('Hello World');
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
