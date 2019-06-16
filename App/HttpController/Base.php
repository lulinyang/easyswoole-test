<?php

namespace App\HttpController;

use EasySwoole\Template\Render;
use App\Utility\PlatesRender;
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
}
