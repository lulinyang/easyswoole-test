<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\AbstractRouter;
use FastRoute\RouteCollector;

class Router extends AbstractRouter
{
    public function initialize(RouteCollector $routeCollector)
    {
        // $this->setGlobalMode(true);
        $routeCollector->get('/', '/Index/index');
        $routeCollector->get('/websocket', '/WebSocket/index');
    }
}
