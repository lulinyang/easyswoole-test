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
        // $this->setGlobalMode(false);
        $routeCollector->addRoute(['GET', 'POST'], '/', '/Index/index');
        $routeCollector->addRoute(['GET', 'POST'], '/list', '/Index/list');
        $routeCollector->addRoute(['GET', 'POST'], '/websocket', '/WebSocket/index');
        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            $response->write('未找到处理方法');
        });
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            $response->write('未找到路由匹配');
        });
        // TODO: Implement initialize() method.
    }
}
