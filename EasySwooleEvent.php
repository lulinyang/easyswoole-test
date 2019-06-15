<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/5/28
 * Time: 下午6:33.
 */

namespace EasySwoole\EasySwoole;

use EasySwoole\EasySwoole\Swoole\EventRegister;
use EasySwoole\EasySwoole\AbstractInterface\Event;
use EasySwoole\Http\Request;
use EasySwoole\Http\Response;
use EasySwoole\Utility\File;
use EasySwoole\MysqliPool\Mysql;

class EasySwooleEvent implements Event
{
    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        // var_dump(EASYSWOOLE_ROOT.'/App/Config');
        self::loadConf(EASYSWOOLE_ROOT.'/App/Config');
        $dbConf = Config::getInstance()->getConf('DATABASE');
        var_dump($dbConf);
        // $mysqlConfig = new \EasySwoole\Mysqli\Config($dbConf['MYSQL']);
        // $poolConfig = Mysql::getInstance()->register('mysql', $mysqlConfig);
        // //根据返回的poolConfig对象进行配置连接池配置项
        var_dump($dbConf['MYSQL']['maxObjectNum']);
        // $poolConfig->setMaxObjectNum($dbConf['MYSQL']['maxObjectNum']);
    }

    public static function loadConf($ConfPath)
    {
        $Conf = Config::getInstance();
        $files = File::scanDirectory($ConfPath);
        if (!is_array($files)) {
            return;
        }
        foreach ($files['files'] as $file) {
            $data = require_once $file;
            $Conf->setConf(strtoupper(basename($file, '.php')), (array) $data);
        }
    }

    public static function mainServerCreate(EventRegister $register)
    {
        // TODO: Implement mainServerCreate() method.
    }

    public static function onRequest(Request $request, Response $response): bool
    {
        // TODO: Implement onRequest() method.
        return true;
    }

    public static function afterRequest(Request $request, Response $response): void
    {
        // TODO: Implement afterAction() method.
    }
}
