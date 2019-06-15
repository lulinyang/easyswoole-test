<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/11/26
 * Time: 12:31 PM.
 */

namespace App\Model;

use App\Utility\Pool\MysqlObject;

/**
 * model写法1
 * 通过传入mysql连接去进行处理
 * Class BaseModel.
 */
class BaseModel
{
    private $db;

    public function __construct(MysqlObject $dbObject)
    {
        $this->db = $dbObject;
    }

    protected function getDb(): MysqlObject
    {
        return $this->db;
    }

    public function getDbConnection(): MysqlObject
    {
        return $this->db;
    }

    public function getAll($condition = [], int $page = 1, $pageSize = 10): array
    {
        $allow = ['where', 'orWhere', 'join', 'orderBy', 'groupBy'];
        foreach ($condition as $k => $v) {
            if (in_array($k, $allow)) {
                foreach ($v as $item) {
                    $this->getDb()->$k(...$item);
                }
            }
        }
        $list = $this->getDb()
            ->withTotalCount()
            // ->orderBy('created_at', 'DESC')
            ->get($this->tableName, [$pageSize * ($page - 1), $pageSize]);
        $total = $this->getDb()->getTotalCount();

        return ['total' => $total, 'pageNo' => $page, 'list' => $list];
    }
}
