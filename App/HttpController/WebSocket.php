<?php

namespace App\HttpController;

class WebSocket extends base
{
    public function index()
    {
        $content = file_get_contents(__DIR__.'/websocket.html');
        $this->response()->write($content);
        $this->response()->end();
    }
}
