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

class EasySwooleEvent implements Event
{
    public static function initialize()
    {
        // TODO: Implement initialize() method.
        date_default_timezone_set('Asia/Shanghai');
        var_dump(EASYSWOOLE_ROOT.'/App/Config');
        self::loadConf(EASYSWOOLE_ROOT.'/App/Config');
        // $mysqlConfig = new \EasySwoole\Mysqli\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        // $poolConfig = \EasySwoole\MysqliPool\Mysql::getInstance()->register('mysql', $mysqlConfig);
        // //根据返回的poolConfig对象进行配置连接池配置项
        // $poolConfig->setMaxObjectNum(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL.maxObjectNum'));
    }

    public static function loadConf($ConfPath)
    {
        $Conf = \EasySwoole\EasySwoole\Config::getInstance();
        $files = File::scanDirectory($ConfPath);
        var_dump($files);
        if (!is_array($files)) {
            return;
        }
        foreach ($files as $file) {
            var_dump($file);
            $data = require_once $file;
            $Conf->setConf(strtolower(basename($file, '.php')), (array) $data);
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
