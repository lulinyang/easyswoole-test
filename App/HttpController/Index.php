<?php

namespace App\HttpController;

use EasySwoole\Config;

class Index extends Base
{
    public function index()
    {
        $conf = Config::getInstance()->getConf('SERVER_NAME');
        // $this->response()->write('Hello World');
        var_dump($conf);
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
