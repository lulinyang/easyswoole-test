<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->response()->write('Hello World');
    }

    public function test()
    {
        $this->response()->write('Hello World');
    }
}
