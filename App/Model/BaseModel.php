<?php

namespace App\Model;

/**
 * model写法1
 * 通过传入mysql连接去进行处理
 * Class BaseModel.
 */
class BaseModel extends Model
{
    /**
     * 查询分页数据.
     */
    public function paginate(array $condition, int $page = 1, $pageSize = 10): array
    {
        $allow = ['where', 'orWhere', 'join', 'orderBy', 'groupBy'];
        foreach ($condition as $k => $v) {
            if (in_array($k, $allow)) {
                foreach ($v as $item) {
                    $this->getDb()->$k(...$item);
                }
            }
        }

        $list = $this->getDb()->get($this->tableName, [$pageSize * ($page - 1), $pageSize]);
        // $sql = $this->getDb()->getLastQuery();
        $total = $this->getDb()->getTotalCount();

        return ['total' => $total, 'pageNo' => $page, 'list' => $list];
    }

    public function select($columns = '*')
    {
        return $this->getDb()->get($this->tableName, null, $columns);
    }

    public function find($condition = [], $columns = '*')
    {
        if (!empty($condition)) {
            $allow = ['where', 'orWhere', 'join'];
            foreach ($condition as $k => $v) {
                if (in_array($k, $allow)) {
                    foreach ($v as $item) {
                        $this->getDb()->$k(...$item);
                    }
                }
            }

            return $this->getDb()->getOne($this->tableName, $columns);
        } else {
            return $this->getDb()->where('id', $condition, '=')->getOne($this->tableName, $columns);
        }
    }

    public function update(array $condition, array $data)
    {
        $allow = ['where', 'orWhere'];
        foreach ($condition as $k => $v) {
            if (in_array($k, $allow)) {
                foreach ($v as $item) {
                    $this->getDb()->$k(...$item);
                }
            }
        }
        $this->getDb()->update($this->tableName, $data);

        return $this->getDb()->getAffectRows();
    }

    public function insert(array $data)
    {
        return $this->getDb()->insert($this->tableName, $data);
    }

    public function delete($condition = [])
    {
        if (!empty($condition)) {
            $allow = ['where', 'orWhere'];
            foreach ($condition as $k => $v) {
                if (in_array($k, $allow)) {
                    foreach ($v as $item) {
                        $this->getDb()->$k(...$item);
                    }
                }
            }

            return $this->getDb()->delete($this->tableName);
        } else {
            return $this->getDb()->where('id', $condition, '=')->delete($this->tableName);
        }
    }
}
