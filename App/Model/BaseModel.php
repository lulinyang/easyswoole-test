<?php

namespace App\Model;

/**
 * model写法1
 * 通过传入mysql连接去进行处理
 * Class BaseModel.
 */
class BaseModel extends Model
{
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
