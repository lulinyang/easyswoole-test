<?php

namespace App\HttpController;

use EasySwoole\Template\Render;
use App\Tools\PlatesRender;
use EasySwoole\Http\AbstractInterface\Controller;

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
        // $this->response()->write('404');
        $this->render('error');
    }
}
