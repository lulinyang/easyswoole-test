<?php

namespace App\HttpController;

use EasySwoole\EasySwoole\Config;

class Index extends Base
{
    public function index()
    {
        // $conf = Config::getInstance()->load('database.php');
        $Conf = Config::getInstance()->loadFile(EASYSWOOLE_ROOT.'/App/Config/database');
        // $this->response()->write('Hello World');
        $this->writeJson(200, $conf, 'success');
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
