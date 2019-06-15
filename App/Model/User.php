<?php

namespace App\Model;

class User extends BaseModel
{
    protected $tableName = 'users';
    protected $name;
    protected $email;
    protected $password;
    protected $created_at;
    protected $updated_at;

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
            ->orderBy('created_at', 'DESC')
            ->get($this->tableName, [$pageSize * ($page - 1), $pageSize]);
        $total = $this->getDb()->getTotalCount();

        return ['total' => $total, 'pageNo' => $page, 'list' => $list];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getcreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setcreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getupdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setupdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}
