<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

class Base extends Controller
{
    public function actionNotFound()
    {
        $this->response()->write('404');
        // $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
        //     $response->write('未找到处理方法');

        //     return false; //结束此次响应
        // });
        // $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
        //     $response->write('未找到路由匹配');

        //     return 'index'; //重定向到index路由
        // });
    }
}
