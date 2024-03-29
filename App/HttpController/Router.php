<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use FastRoute\RouteCollector;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

class Router extends AbstractRouter
{
    public function initialize(RouteCollector $routeCollector)
    {
        $this->setGlobalMode(true);
        //测试
        $routeCollector->addRoute(['GET', 'POST'], '/', '/Index/index');
        $routeCollector->addRoute(['GET', 'POST'], '/list', '/Index/list');

        /*-------------------------------------api----------------------------------------*/
        //注册
        $routeCollector->addRoute(['POST'], '/api/register', '/UserController/register');
        $routeCollector->addRoute(['POST'], '/api/login', '/UserController/login');
        $routeCollector->addRoute(['POST'], '/api/userList', '/UserController/list');
        /*--------------------------------------------------------------------------------*/
        //websocket推送消息
        $routeCollector->addRoute(['GET', 'POST'], '/websocket', '/WebSocket/index');
        $routeCollector->addRoute(['GET', 'POST'], '/reply', '/WebSocket/reply');

        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            $response->write('未找到处理方法');
        });
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            $response->write('未找到路由匹配');
        });
        // TODO: Implement initialize() method.
    }
}
