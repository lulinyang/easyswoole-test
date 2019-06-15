<?php

namespace App\HttpController;

class Index extends Base
{
    public function index()
    {
        $this->response()->write('Hello World');
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
