<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/8/28
 * Time: 下午6:41.
 */

namespace App\Model;

use EasySwoole\Spl\SplBean;

/**
 * 快捷查询条件
 * Class ConditionBean.
 */
class ConditionBean extends SplBean
{
    protected $conditions = [];
    protected $columns = '*';
    protected $pagination = null;

    /**
     * 添加Where条件.
     *
     * @param $whereProp
     * @param string $whereValue
     * @param string $operator
     * @param string $cond
     *
     * @return ConditionBean
     * @author: eValor < master@evalor.cn >
     */
    public function addWhere($whereProp, $whereValue = 'DBNULL', $operator = '=', $cond = 'AND')
    {
        $this->conditions['where'][] = [$whereProp, $whereValue, $operator, $cond];

        return $this;
    }

    /**
     * 添加orWhere条件.
     *
     * @param $whereProp
     * @param string $whereValue
     * @param string $operator
     *
     * @return ConditionBean
     * @author: eValor < master@evalor.cn >
     */
    public function addOrWhere($whereProp, $whereValue = 'DBNULL', $operator = '=')
    {
        $this->conditions['orWhere'][] = [$whereProp, $whereValue, $operator];

        return $this;
    }

    /**
     * 添加Join条件
     * TODO:: 可以继续实现一个字段控制逻辑 即这个where条件需要select什么字段.
     *
     * @param $joinTable
     * @param $joinCondition
     * @param string $joinType
     *
     * @return ConditionBean
     * @author: eValor < master@evalor.cn >
     */
    public function addJoin($joinTable, $joinCondition, $joinType = '')
    {
        $this->conditions['join'][] = [$joinTable, $joinCondition, $joinType];

        return $this;
    }

    /**
     * 添加OrderBy条件.
     *
     * @param $orderByField
     * @param string $orderByDirection
     * @param null   $customFieldsOrRegExp
     *
     * @return ConditionBean
     * @author: eValor < master@evalor.cn >
     */
    public function addOrderBy($orderByField, $orderByDirection = 'DESC', $customFieldsOrRegExp = null)
    {
        $this->conditions['orderBy'][] = [$orderByField, $orderByDirection, $customFieldsOrRegExp];

        return $this;
    }

    /**
     * 添加GroupBy条件.
     *
     * @param $groupByField
     *
     * @return ConditionBean
     * @author: eValor < master@evalor.cn >
     */
    public function addGroupBy($groupByField)
    {
        $this->conditions['groupBy'][] = [$groupByField];

        return $this;
    }

    /**
     * 设置字段.
     *
     * @param string $columns
     * @author: eValor < master@evalor.cn >
     *
     * @return ConditionBean
     */
    public function setColumns($columns = '*')
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * 获取字段.
     *
     * @return mixed
     * @author: eValor < master@evalor.cn >
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * 设置分页查询.
     *
     * @param $page
     * @param int $limit
     * @author: eValor < master@evalor.cn >
     *
     * @return ConditionBean
     */
    public function setPagination($page, $limit = 20)
    {
        $this->pagination = [intval($page) * 1 > 0 ? intval($page - 1) * 1 * $limit : 0, $limit];

        return $this;
    }

    /**
     * 获取分页查询.
     *
     * @return mixed
     * @author: eValor < master@evalor.cn >
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * 返回查询条件.
     *
     * @param array|null $columns
     * @param null       $filter
     *
     * @return array
     * @author: eValor < master@evalor.cn >
     */
    public function toArray(array $columns = null, $filter = null): array
    {
        return $this->conditions;
    }
}
