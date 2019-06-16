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
        // $this->setGlobalMode(true);
        // $this->setGlobalMode(false);
        $routeCollector->get('/', function (Request $request, Response $response) {
            $response->write('this router index');
            $response->end();
        });
        $this->setMethodNotAllowCallBack(function (Request $request, Response $response) {
            $response->write('未找到处理方法');
        });
        $this->setRouterNotFoundCallBack(function (Request $request, Response $response) {
            $response->write('未找到路由匹配');
        });
        // TODO: Implement initialize() method.
    }
}
