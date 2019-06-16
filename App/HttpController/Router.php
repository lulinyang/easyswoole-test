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
        $this->setGlobalMode(false);
        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            $response->write('未找到处理方法');

            return false;
        });
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            $response->write('未找到路由匹配');

            return false;
        });
        $routeCollector->post('/', '/Index/index');
        $routeCollector->post('/websocket', '/WebSocket/index');
    }
}
