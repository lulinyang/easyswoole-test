<?php

namespace App\HttpController;

use EasySwoole\Template\Render;
use App\Utility\PlatesRender;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;

class Base extends Controller
{
    public function index()
    {
        // $this->actionNotFound('error');
    }

    /**
     * 分离式渲染.
     *
     * @param $template
     * @param $vars
     */
    private function render($template, array $vars = [])
    {
        $engine = new PlatesRender(EASYSWOOLE_ROOT.'/App/Views');
        $render = Render::getInstance();
        $render->getConfig()->setRender($engine);
        $content = $engine->render($template, $vars);
        $this->response()->write($content);
    }

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
