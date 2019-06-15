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
    public function paginate($condition = [], int $page = 1, $pageSize = 10): array
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
            // ->withTotalCount()
            // ->orderBy('created_at', 'DESC')
            ->get($this->tableName, [$pageSize * ($page - 1), $pageSize]);
        // $sql = $this->getDb()->getLastQuery();
        $total = $this->getDb()->getTotalCount();

        return ['total' => $total, 'pageNo' => $page, 'list' => $list];
    }

    public function find($condition = [])
    {
        $allow = ['where', 'orWhere', 'join'];
        foreach ($condition as $k => $v) {
            if (in_array($k, $allow)) {
                foreach ($v as $item) {
                    $this->getDb()->$k(...$item);
                }
            }
        }
        $data = $this->getDb()->getOne($this->tableName);
        $sql = $this->getDb()->getLastQuery();

        return  ['data' => $data, 'sql' => $sql];
    }

    public function update(MemberBean $memberBean, array $data)
    {
        $this->getDb()->where('member_id', $memberBean->getMemberId())->update($this->table, $data);

        return $this->getDb()->getAffectRows();
    }

    public function register(MemberBean $bean)
    {
        return $this->getDb()->insert($this->table, $bean->toArray());
    }

    public function delete(MemberBean $bean)
    {
        return $this->getDb()->where('member_id', $bean->getMemberId())->delete($this->table);
    }
}
