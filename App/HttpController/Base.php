<?php

namespace App\HttpController;

use EasySwoole\Http\AbstractInterface\Controller;
use App\Model\ConditionBean;

class Base extends Controller
{
    protected $con;

    public function __construct()
    {
        $this->con = new ConditionBean();
    }

    public function index()
    {
        // $this->actionNotFound('error');
        // ConditionBean
    }
}
